<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\Course;
use App\Models\User;
use App\Http\Requests\ScheduleStudentRequest;
use App\Helpers\MailHelper;
use App\Models\TopicCourse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

class ScheduleStudentController extends Controller
{
    public function __construct(Notification $notification, Course $course, User $user)
    {
        view()->share([
            'schedule_active' => 'active',
            'courses' => $course->orderBy('id', 'DESC')->get(),
            'users' => $user->where('type', User::STUDENT)->get(),
            'status' => Notification::STATUS,
            'schedule_types' => Notification::SCHEDULE_TYPES,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $notifications = Notification::select('*')->with(['notificationUsers' => function ($query) {
            $query->with('user');
        }, 'user']);

        $user = Auth::user();
        if ($user->hasRole(User::ROLE_USERS)) {
            $notifications->where('n_user_id', $user->id);
        }

        $notifications = $notifications->where('n_type', 6)->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.schedule.index', compact('notifications'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        // $topics = $user->topicsAsTeacher->unique('id');//$topics ~ TopicCourse
        $topics = $user->topicsAsTeacher()->with('topic')->get()->unique('id');//$topics ~ TopicCourse
        return view('admin.schedule.create', compact('topics'));
    }

    public function getStudentList(Request $request)
    {
        $topic = TopicCourse::where('id', $request->id)->first();//$topic ~ TopicCourse
        $studentList = $topic->students;
        return $studentList;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleStudentRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'topic_id', 'submit', 'users');

            $adminOrTeacher = Auth::user();
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $data['n_user_id'] = $adminOrTeacher->id;
            $data['n_send_to'] = 2;
            $data['n_type'] = 6;
            $data['location'] = $data['meeting_type'] === 'offline' ? $data['location'] : 'Unknown Location';
            $data['location_details'] = $data['meeting_type'] === 'offline' ? $data['location_details'] : 'No details';

            $id = Notification::insertGetId($data);
            if ($id) {
                $users = User::whereIn('id', $request->users)->get();

                foreach ($users as $user) {
                    $notificationUser = [
                        'nu_notification_id' => $id,
                        'nu_user_id' => $user->id,
                        'nu_type_user' => $user->type,
                        'nu_status' => 1,
                    ];

                    NotificationUser::create($notificationUser);
                    // send email
                    $dataMail = [
                        'subject' => $data['n_title'],
                        'nu_notification_id' => $id,
                        'nu_user_id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'content' => $data['n_content'],
                        'user' => $adminOrTeacher->toArray(),
                    ];
                    $dataMail['location'] = $data['meeting_type'] === 'offline' ? $data['location'] : '(Online meeting)';
                    $dataMail['location_details'] = $data['meeting_type'] === 'offline' ? $data['location_details'] : '(Online meeting)';
                    $dataMail['date_book'] = $request->n_from_date;
                    $dataMail['end_date_book'] = $request->n_end_date;
                    MailHelper::sendMailNotification($dataMail);
                }
            }
            \DB::commit();
            return redirect()->route('schedule.student.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //query topics of teacher
        $user = Auth::user();
        $topics = $user->topicsAsTeacher()->with('topic')->get()->unique('id');//$topics ~ TopicCourse
        //query notified student list
        $notification = Notification::with(['notificationUsers' => function($query) {
            $query->with('user');
        }])->find($id);
        //query notified student list
        $notifiedStudentList = $notification->users;

        if(!$notification) {
            return redirect()->route('get.list.user')->with('danger', 'Quyền không tồn tại');
        }

        $viewData = ['notification' => $notification, 'notifiedStudentList' => $notifiedStudentList, 'topics' => $topics];
        return view('admin.schedule.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleStudentRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'topic_id', 'submit', 'users');

            $adminOrTeacher = Auth::user();

            $data['n_user_id'] = $adminOrTeacher->id;
            $data['updated_at'] = Carbon::now();
            $data['n_send_to'] = 2;
            $data['n_type'] = 6;
            $data['location'] = $data['meeting_type'] === 'offline' ? $data['location'] : 'Unknown Location';
            $data['location_details'] = $data['meeting_type'] === 'offline' ? $data['location_details'] : 'No details';

            $notification = Notification::find($id);
            
            if ($notification) {
                $notification->update($data);
                if ($id) {
                    $users = User::whereIn('id', $request->users)->get();

                    foreach ($users as $user) {
                        $notificationUser = [
                            'nu_notification_id' => $id,
                            'nu_user_id' => $user->id,
                            'nu_type_user' => $user->type,
                            'nu_status' => 1,
                        ];


                        NotificationUser::updateOrCreate(
                            ['nu_notification_id' => $id, 'nu_user_id' => $user->id],
                            $notificationUser
                        );

                        // send email
                        $dataMail = [
                            'subject' => $data['n_title'],
                            'nu_notification_id' => $id,
                            'nu_user_id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'content' => $data['n_content'],
                            'user' => $adminOrTeacher->toArray(),
                        ];
                        $dataMail['location'] = $data['meeting_type'] === 'offline' ? $data['location'] : '(Online meeting)';
                        $dataMail['location_details'] = $data['meeting_type'] === 'offline' ? $data['location_details'] : '(Online meeting)';
                        $dataMail['date_book'] = $request->n_from_date;
                        $dataMail['end_date_book'] = $request->n_end_date;
                        MailHelper::sendMailNotification($dataMail);
                    }
                }
            }
            \DB::commit();
            return redirect()->route('schedule.student.index')->with('success', 'Cập nhật thành công thông báo');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể cập nhật thông báo');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $notification = Notification::find($id);

        if (!$notification) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        try {
            $notification->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function show($id)
    {
        $status = [
            0 => 'Chờ xác nhận',
            1 => 'Tham gia',
            2 => 'Không tham gia'
        ];
        $notification = Notification::find($id);

        if (!$notification) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.schedule.show', compact('notification', 'status'));
    }

    public function confirm(Request $request, $noti_id, $user_id)
    {
        $user = NotificationUser::where(['nu_notification_id' => $noti_id, 'nu_user_id' => $user_id])->first();

        if (!$user) {
            return abort(404);
        }
        $userCheck = User::find($user_id);

        try {
            NotificationUser::where(['nu_notification_id' => $noti_id, 'nu_user_id' => $user_id])->update(['nu_status' => $request->type]);
            $title = $request->type == 1 ? 'Tham gia' : 'Không tham gia';

            if (isset($userCheck) && $userCheck->hasRole('sv')) {
                return view('page.notifications.confirm', compact('title'));
            } else {
                return view('admin.notification.confirm', compact('title', 'userCheck'));
            }

        } catch (\Exception $exception) {
            return abort(404);
        }
    }
}
