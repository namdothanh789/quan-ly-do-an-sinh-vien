<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;


class User extends Authenticatable
{
    use HasFactory, Notifiable, LaravelEntrustUserTrait;

    const GENDER = [
        1 => 'Nam',
        2 => 'Nữ'
    ];
    const STATUS = [
        1 => 'Hoạt động',
        2 => 'Đã khóa',
    ];

    const TEACHER = 1;
    const STUDENT = 2;
    const ROLE_STUDENT = 5;
    const ROLE_USERS = ['gvhd', 'gv', 'bcn-khoa'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'email',
        'password',
        'phone',
        'email_verified_at',
        'avatar',
        'address',
        'birthday',
        'gender',
        'status',
        'type',
        'flag',
        'course_id',
        'department_id',
        'position_id',
        'point_medium'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getInfoEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function userRole()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    // Relationship for students
    public function topicsAsStudent()
    {
        return $this->belongsToMany(TopicCourse::class, 'student_topics', 'st_student_id', 'st_topic_id')
                    ->withPivot('st_teacher_id');
    }

    // Relationship for teachers
    public function topicsAsTeacher()
    {
        return $this->belongsToMany(TopicCourse::class, 'student_topics', 'st_teacher_id', 'st_topic_id')
                    ->withPivot('st_student_id');
    }

    //danh sách những thông báo được gửi đến user
    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_users', 'nu_user_id', 'nu_notification_id')
                    ->withPivot('nu_status', 'nu_type_user');
    }

    //danh sách những thông báo do user chủ động gửi
    public function sentNotifications()
    {
        return $this->hasMany(Notification::class, 'n_user_id');
    }
}

