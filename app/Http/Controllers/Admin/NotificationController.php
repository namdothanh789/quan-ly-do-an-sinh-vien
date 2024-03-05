<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\Course;
use App\Models\User;
use App\Http\Requests\NotificationRequest;
use App\Helpers\MailHelper;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function __construct(Notification $notification, Course $course, User $user)
    {
        view()->share([
            'notification_active' => 'active',
            'courses' => $course->orderBy('id', 'DESC')->get(),
            'types'  => $notification::TYPES,
            'sendTo' => $notification::SEND_TO,
            'users' => $user->all(),
            'status' => Notification::STATUS
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
        $notifications = Notification::select('id', 'n_course_id', 'n_title', 'n_type', 'n_status', 'n_send_to')->with('course');
        if ($request->n_title) {
            $notifications->where('n_title', 'like', '%'.$request->n_title.'%');
        }
        if ($request->n_course_id) {
            $notifications->where('n_course_id', $request->n_course_id);
        }
        if ($request->n_type) {
            $notifications->where('n_type', $request->n_type);
        }
        if ($request->n_send_to) {
            $notifications->where('n_send_to', $request->n_send_to);
        }
        if ($request->n_status) {
            $notifications->where('n_status', $request->n_status);
        }

        $notifications = $notifications->orderByDesc('id')->paginate(NUMBER_PAGINATION);

        return view('admin.notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'users');
            $listUsers = $request->users;

            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();

            $id = Notification::insertGetId($data);
            if ($id) {
                $users = User::where(['type' => $data['n_send_to']]);

                if ($request->n_send_to == User::STUDENT) {
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
                        'nu_type_user' => $data['n_send_to'],
                        'nu_status' => 1,
                    ];

                    if (!empty($listUsers) && in_array($user->id, $listUsers)) {
                        $notificationUser['nu_status'] = 2;
                    }

                    NotificationUser::create($notificationUser);
                    // send email
                    if ($request->n_status == 1) {
                        $dataMail = [
                            'subject' => $data['n_title'],
                            'name' => $user->name,
                            'email' => $user->email,
                            'content' => $data['n_content'],
                        ];
                        MailHelper::sendMailNotification($dataMail);
                    }
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
        return view('admin.notification.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'users');
            $listUsers = $request->users ? $request->users : [];
            $data['updated_at'] = Carbon::now();
            $notification = Notification::find($id);
            if ($notification) {
                $notification->update($data);
                if ($id) {
                    $users = User::where(['type' => $data['n_send_to']]);

                    if ($request->n_send_to == User::STUDENT) {
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
                            'nu_type_user' => $data['n_send_to'],
                            'nu_status' => 1,
                        ];

                        if (in_array($user->id, $listUsers)) {
                            $notificationUser['nu_status'] = 2;
                        }

                        if (NotificationUser::where('nu_notification_id', $id)->delete()) {
                            NotificationUser::create($notificationUser);
                        }

                        // send email
                        if ($request->n_status == 1) {
                            $dataMail = [
                                'subject' => $data['n_title'],
                                'name' => $user->name,
                                'email' => $user->email,
                                'content' => $data['n_content'],
                            ];
                            MailHelper::sendMailNotification($dataMail);
                        }
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
}
