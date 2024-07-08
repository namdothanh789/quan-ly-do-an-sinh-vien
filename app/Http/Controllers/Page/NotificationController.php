<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ScheduleTeacherRequest;
use Carbon\Carbon;
use App\Helpers\MailHelper;

class NotificationController extends Controller
{
    public function __construct()
    {
        view()->share([
            'schedule_types' => Notification::SCHEDULE_TYPES,
        ]);
    }

    public function index(Request $request)//đang không dùng
    {
        $user = Auth::guard('students')->user();
        $notifications = Notification::where(['n_status' => 1])->whereIn('id', function ($query) use($user) {
            $query->from('notification_users')
                ->select('nu_notification_id')
                ->where('nu_user_id', $user->id);

        })->orderByDesc('id')->paginate(NUMBER_PAGINATION);

        return view('page.notifications.index', compact('notifications'));
    }

    public function details($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        $notification->n_watched = 1;
        $notification->save();

        return view('page.notifications.details', compact('notification'));
    }


    public function schedules()
    {
        $user = Auth::guard('students')->user();

        $notifications = Notification::with(['notificationUsers' => function($query) {
            $query->with('user');
        }])->where(['n_user_id' => $user->id])->orderByDesc('id')->paginate(NUMBER_PAGINATION);

        return view('page.schedule.index', compact('notifications'));
    }


    public function create()
    {
        $student = Auth::guard('students')->user();
        $studentTopic = $student->topicsAsStudent->first(); //first will return 1 model, get will return collection of models
        $teacher = $studentTopic->teachers->first();
        $sameTopicStudentList = $studentTopic->students;
        return view('page.schedule.create', compact('teacher', 'sameTopicStudentList'));
    }

    public function store(ScheduleTeacherRequest $request)
    {

        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'teacher_id', 'users');
            
            $student = Auth::guard('students')->user();
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $data['n_user_id'] = $student->id;
            $data['n_send_to'] = 1;
            $data['n_type'] = 7;
            $data['location'] = $data['meeting_type'] === 'offline' ? $data['location'] : 'Unknown Location';
            $data['location_details'] = $data['meeting_type'] === 'offline' ? $data['location_details'] : 'No details';

            $id = Notification::insertGetId($data);
            if ($id) {
                // Initialize the $users array
                $users = ($request->n_schedule_type == 'red') ? User::whereIn('id', $request->users)->orWhere('id', $request->teacher_id)->get() : User::where('id', $request->teacher_id)->get();
                
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
                        'user' => $student->toArray()
                    ];
                    $dataMail['location'] = $data['meeting_type'] === 'offline' ? $data['location'] : '(Online meeting)';
                    $dataMail['location_details'] = $data['meeting_type'] === 'offline' ? $data['location_details'] : '(Online meeting)';
                    $dataMail['date_book'] = $request->n_from_date;
                    $dataMail['end_date_book'] = $request->n_end_date;
                    MailHelper::sendMailNotification($dataMail);
                }
            }
            \DB::commit();
            return redirect()->route('user.schedule.teacher')->with('success', 'Thêm mới thành công');
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
        $student = Auth::guard('students')->user();
        $studentTopic = $student->topicsAsStudent->first();
        $teacher = $studentTopic->teachers->first();
        $sameTopicStudentList = $studentTopic->students;
        //query student list, not contain teacher
        $notification = Notification::with(['notificationUsers' => function($query) use ($teacher) {
            $query->where('nu_user_id', '<>', $teacher->id)->with('user');
        }])->find($id);
        //query student_id array and assign to $notifiedStudentList, where nu_user_id != $teacher->id
        $notifiedStudentList = [];
        foreach ($notification->notificationUsers as $notificationUser) {
            if ($notificationUser->nu_user_id!= $teacher->id) {
                $notifiedStudentList[] = $notificationUser->nu_user_id;
            }
        }
        
        if(!$notification) {
            return redirect()->route('get.list.user')->with('danger', 'Quyền không tồn tại');
        }
        
        $viewData = ['notification' => $notification, 'teacher' => $teacher, 'sameTopicStudentList' => $sameTopicStudentList, 'notifiedStudentList' => $notifiedStudentList];
        return view('page.schedule.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleTeacherRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'teacher_id', 'users');

            $student = Auth::guard('students')->user();
            $data['n_user_id'] = $student->id;
            $data['updated_at'] = Carbon::now();
            $data['n_send_to'] = 1;
            $data['n_type'] = 7;
            $data['location'] = $data['meeting_type'] === 'offline' ? $data['location'] : 'Unknown Location';
            $data['location_details'] = $data['meeting_type'] === 'offline' ? $data['location_details'] : 'No details';

            $notification = Notification::find($id);
            if ($notification) {
                $notification->update($data);
                if ($id) {

                    $users = ($request->n_schedule_type == 'red') ? User::whereIn('id', $request->users)->orWhere('id', $request->teacher_id)->get() : User::where('id', $request->teacher_id)->get();

                    foreach ($users as $user) {
                        $notificationUser = [
                            'nu_notification_id' => $id,
                            'nu_user_id' => $user->id,
                            'nu_type_user' => $user->type,
                            'nu_status' => 1,
                        ];

                        if (NotificationUser::where('nu_notification_id', $id)->where('nu_user_id', $user->id)->delete()) {
                            NotificationUser::create($notificationUser);
                        }

                        // send email
                        $dataMail = [
                            'subject' => $data['n_title'],
                            'nu_notification_id' => $id,
                            'nu_user_id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'content' => $data['n_content'],
                            'user' => $student->toArray()
                        ];
                        $dataMail['location'] = $data['meeting_type'] === 'offline' ? $data['location'] : '(Online meeting)';
                        $dataMail['location_details'] = $data['meeting_type'] === 'offline' ? $data['location_details'] : '(Online meeting)';
                        if ($request->n_from_date) {
                            $dataMail['date_book'] = $request->n_from_date;
                            $dataMail['end_date_book'] = $request->n_end_date;
                        }
                        MailHelper::sendMailNotification($dataMail);
                    }
                }
            }
            \DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công thông báo');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
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

    public function calendar()
    {
        $notifications = Notification::select('*')->with(['notificationUsers' => function ($query) {
            $query->with('user');
        }, 'user']);

        $user = Auth::guard('students')->user();

        $userId = $user->id;

        $notifications->where('n_user_id', $userId)->orWhereIn('id', function ($query) use($userId) {
            $query->select('nu_notification_id')->from('notification_users')->where('nu_user_id', $userId);
        });

        $notifications = $notifications->whereIn('n_type', [6, 7])->orderByDesc('id')->get();

        return view('page.schedule.calendar', compact('notifications'));
    }

    public function show($id)
    {
        $status = [
            0 => 'Chờ xác nhận',
            1 => 'Tham gia',
            2 => 'Không tham gia'
        ];
        $notification = Notification::with('notificationUsers')->find($id);

        if (!$notification) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('page.schedule.show', compact('notification', 'status'));
    }
}