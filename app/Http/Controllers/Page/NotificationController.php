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

    public function index(Request $request)
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
        $users = User::where('type', User::TEACHER)->where('id', '<>', 1)->get();
        return view('page.schedule.create', compact('users'));
    }

    public function store(ScheduleTeacherRequest $request)
    {

        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'teacher_id');

            $student = Auth::guard('students')->user();
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $data['n_user_id'] = $student->id;
            $data['n_type'] = 7;

            $id = Notification::insertGetId($data);
            if ($id) {
                $users = User::where('id', $request->teacher_id)->get();


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
        $notification = Notification::with(['notificationUsers' => function($query) {
            $query->with('user');
        }])->find($id);
        if(!$notification) {
            return redirect()->route('get.list.user')->with('danger', 'Quyền không tồn tại');
        }
        $users = User::where('type', User::TEACHER)->where('id', '<>', 1)->get();

        $viewData = ['notification' => $notification, 'users' => $users];
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
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'teacher_id');

            $user = Auth::guard('students')->user();
            $data['n_user_id'] = $user->id;
            $data['updated_at'] = Carbon::now();
            $data['n_type'] = 7;

            $notification = Notification::find($id);
            if ($notification) {
                $notification->update($data);
                if ($id) {

                    $users = User::where('id', $request->teacher_id)->get();

                    foreach ($users as $user) {
                        $notificationUser = [
                            'nu_notification_id' => $id,
                            'nu_user_id' => $user->id,
                            'nu_type_user' => $user->type,
                            'nu_status' => 1,
                        ];

                        if (NotificationUser::where('nu_notification_id', $id)->delete()) {
                            NotificationUser::create($notificationUser);
                        }

                        // send email
                        $dataMail = [
                            'subject' => $data['n_title'],
                            'name' => $user->name,
                            'email' => $user->email,
                            'content' => $data['n_content'],
                        ];
                        if ($request->n_from_date) {
                            $dataMail['date_book'] = $request->n_from_date;
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