<?php
namespace App\Http\ViewComposer;
use DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\NotificationUser;

class NotificationComposer
{
    public function compose(View $view)
    {
        $user = Auth::guard('students')->user();
        $notifications = Notification::where(['n_course_id' => $user->course_id, 'n_status' => 1])->whereIn('id', function ($query) use($user) {
            $query->from('notification_users')
                ->select('nu_notification_id')
                ->where('nu_user_id', $user->id);

        })->orderByDesc('id')->limit(20)->get();
        $view->with('notifications', $notifications);
    }
}