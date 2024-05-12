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
        //
        return view('admin.schedule.create');
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
            $data = $request->except('_token', 'submit', 'users');
            $listUsers = $request->users;

            $admin = Auth::user();
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $data['n_user_id'] = $admin->id;
            $data['n_type'] = 6;

            $id = Notification::insertGetId($data);
            if ($id) {
                $users = User::select('*');

                if (!empty($data['n_send_to'])) {
                    $users->where(['type' => $data['n_send_to']]);
                }

                if ($request->n_send_to == User::STUDENT && !empty($data['n_course_id'])) {
                    $users->where('course_id', $data['n_course_id']);
                }

                if ($request->users) {
                    $users->orWhereIn('id', $request->users);
                }
                $users = $users->get();

                foreach ($users as $user) {
                    $notificationUser = [
                        'nu_notification_id' => $id,
                        'nu_user_id' => $user->id,
                        'nu_type_user' => $user->type,
                        'nu_status' => 1,
                    ];

                    if (!empty($listUsers) && in_array($user->id, $listUsers)) {
                        $notificationUser['nu_status'] = 2;
                    }

                    NotificationUser::create($notificationUser);
                    // send email
                    $dataMail = [
                        'subject' => 'Thông báo lịch hẹn với giáo viên '.$admin->name,
                        'name' => $user->name,
                        'email' => $user->email,
                        'content' => $data['n_content'],
                        'user' => $admin->toArray(),
                        'nu_notification_id' => $id,
                        'nu_user_id' => $user->id,
                    ];
                    if ($request->n_from_date) {
                        $dataMail['date_book'] = $request->n_from_date;
                        $dataMail['end_date_book'] = $request->n_end_date;
                    }
                    MailHelper::sendMailNotification($dataMail);
                }
            }
            \DB::commit();
            return redirect()->back()->with('success', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
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
        //
        $notification = Notification::find($id);
        $notificationUsers = NotificationUser::where(['nu_notification_id' => $id, 'nu_status' => 2])->pluck('nu_user_id')->toArray();

        if(!$notification) {
            return redirect()->route('get.list.user')->with('danger', 'Quyền không tồn tại');
        }

        $viewData = ['notification' => $notification, 'notificationUsers' => $notificationUsers];
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
            $data = $request->except('_token', 'submit', 'users');
            $listUsers = $request->users ? $request->users : [];

            $admin = Auth::user();

            $data['n_user_id'] = $admin->id;
            $data['updated_at'] = Carbon::now();
            $data['n_type'] = 6;
            $notification = Notification::find($id);

            if ($notification) {
                $notification->update($data);
                if ($id) {
                    $users = User::select('*');

                    if (!empty($data['n_send_to'])) {
                        $users->where(['type' => $data['n_send_to']]);
                    }

                    if ($request->n_send_to == User::STUDENT && !empty($data['n_course_id'])) {
                        $users->where('course_id', $data['n_course_id']);
                    }

                    if ($request->users) {
                        $users->orWhereIn('id', $request->users);
                    }
                    $users = $users->get();

                    foreach ($users as $user) {
                        $notificationUser = [
                            'nu_notification_id' => $id,
                            'nu_user_id' => $user->id,
                            'nu_type_user' => $user->type,
                            'nu_status' => 1,
                        ];

                        if (in_array($user->id, $listUsers)) {
                            $notificationUser['nu_status'] = 2;
                        }

                        if (NotificationUser::where('nu_notification_id', $id)->delete()) {
                            NotificationUser::create($notificationUser);
                        }

                        // send email
                        $dataMail = [
                            'subject' => 'Thông báo lịch hẹn với giáo viên '.$admin->name,
                            'name' => $user->name,
                            'email' => $user->email,
                            'content' => $data['n_content'],
                            'user' => $admin->toArray(),
                            'nu_notification_id' => $id,
                            'nu_user_id' => $user->id,
                        ];
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
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
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
        $user->nu_status = $request->type;

        try {
            $user->save();
            $title = $request->type == 1 ? 'Tham gia' : 'Không tham gia';
            return view('page.notifications.confirm', compact('title'));
        } catch (\Exception $exception) {
            return abort(404);
        }
    }
}
