<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Topic;
use App\Models\Department;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        view()->share([
            'home_active' => 'active',

        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numStudent = User::where('type', User::STUDENT)->count();
        $numTeacher = User::where('type', User::TEACHER)->count();
        $numTopic = Topic::count();
        $numDepartment = Department::count();

        $notifications = Notification::select('*')->with(['notificationUsers' => function ($query) {
            $query->with('user');
        }, 'user']);

        $user = Auth::user();
        if ($user->hasRole(User::ROLE_USERS)) {
            $userId = $user->id;
            $notifications->where('n_user_id', $userId)->orWhereIn('id', function ($query) use($userId) {
                $query->select('nu_notification_id')->from('notification_users')->where('nu_user_id', $userId);
            });
        }

        $notifications = $notifications->whereIn('n_type', [6, 7])->orderByDesc('id')->get();
        //
        $viewData = [
            'numStudent' => $numStudent,
            'numTeacher' => $numTeacher,
            'numTopic' => $numTopic,
            'numDepartment' => $numDepartment,
            'notifications' => $notifications,
        ];

        return view('admin.home.index', $viewData);
    }

}
