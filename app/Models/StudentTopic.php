<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTopic extends Model
{
    use HasFactory;

    const STATUS_CANCEL = 0;
    const STATUS_REGISTER = 1;

    protected $table = 'student_topics';

    // const STATUS_OUTLINE = [
    //     1 => 'Đã Nộp',
    //     2 => 'Đã duyệt',
    //     3 => 'Đã trả về',
    // ];

    // const STATUS = [
    //     0 => 'Chưa duyệt',
    //     1 => 'Đạt',
    //     2 => 'Chưa đạt',

    // ];

    protected $fillable = [
        'st_student_id',
        'st_topic_id',
        'st_teacher_id',
        // 'st_teacher_instructor_id',
        'st_course_id',
        // 'st_outline',
        // 'st_outline_part',
        // 'st_status_outline',
        // 'st_comment_outline',
        // 'st_point_outline',
        // 'st_thesis_book',
        // 'st_thesis_book_part',
        // 'st_status_thesis_book',
        // 'st_comment_thesis_book',
        // 'st_point_thesis_book',
        'st_point',
        // 'st_status',
        // 'st_comments',
        // 'st_point_medium',
        'created_at',
        'updated_at'
    ];

    public function topic()
    {
        return $this->belongsTo(TopicCourse::class, 'st_topic_id');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'id', 'st_student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'st_teacher_id');
    }

    public function student()
    {
        return $this->hasOne(User::class, 'id', 'st_student_id');
    }
    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'st_course_id');
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class, 'student_topic_id');
    }

    // public function result_outline_files()
    // {
    //     return $this->hasMany(ResultFile::class, 'rf_student_topic_id', 'id')->where('rf_type', 1);
    // }

    // public function result_book_files()
    // {
    //     return $this->hasMany(ResultFile::class, 'rf_student_topic_id', 'id')->where('rf_type', 2);
    // }
    /**
     * The "booting" method of the model.
     *
     * This method is called when the model is being booted. It sets up a
     * deleting event listener to perform cleanup operations when a StudentTopic
     * instance is being deleted.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        /**
         * Delete related notifications when a StudentTopic is being deleted.
         *
         * @param \App\Models\StudentTopic $studentTopic The StudentTopic instance being deleted.
         * @return void
         */
        static::deleting(function ($studentTopic) {
            // Delete notifications where the student is the sender
            Notification::where('n_user_id', $studentTopic->st_student_id)->delete();

            // Delete notification_users entries for this student
            NotificationUser::where('nu_user_id', $studentTopic->st_student_id)->delete();
        });
    }
}
