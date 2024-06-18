<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    const TYPES = [
        1 => 'Thông báo thời gian đăng ký đề tài',
        2 => 'Thông báo thời gian nộp đề cương',
        3 => 'Thông báo thời gian nộp đề cương',
        4 => 'Thông báo thời gian nộp đề tài',
        5 => 'Thông báo lịch bảo vệ / nộp đồ án',
        6 => 'Lịch hẹn (teacher to student)',
        7 => 'Lịch hẹn (student to teacher)'
    ];
    const SEND_TO = [
        1 => 'Gửi cho giáo viên',
        2 => 'Gửi cho sinh viên',
    ];
    const STATUS = [
        1 => 'Đã duyệt',
        2 => 'Chưa duyệt',
    ];

    const SCHEDULE_TYPES = [
        'blue' => 'Báo cáo cá nhân',
        'red' => 'Báo cáo nhóm'
    ];
    protected $table = 'notifications';

    protected $fillable = [
        'n_course_id', 'n_user_id', 'n_title', 'n_type', 'n_content', 'n_from_date', 'n_end_date', 'n_send_to', 'n_status', 'n_schedule_type', 'created_at','updated_at','meeting_type', 'location', 'location_details'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'n_course_id', 'id');
    }

    public function notificationUsers()
    {
        return $this->hasMany(NotificationUser::class, 'nu_notification_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'n_user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_users', 'nu_notification_id', 'nu_user_id')
                    ->withPivot('nu_status');
    }
}
