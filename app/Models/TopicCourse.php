<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicCourse extends Model
{
    use HasFactory;
    protected $table = 'topic_course';

    protected $fillable = [
        'tc_topic_id', 'tc_course_id', 'tc_council_id',
        'tc_department_id', 'tc_teacher_id', 'tc_start_time', 'tc_end_time', 'tc_status', 'tc_registration_number', 'created_at', 'updated_at'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'tc_topic_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'tc_course_id');

    }

    public function council()
    {
        return $this->belongsTo(Council::class, 'tc_council_id');

    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'tc_department_id');

    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'tc_teacher_id');

    }

    public function studentTopics()
    {
        return $this->hasMany(StudentTopic::class, 'st_topic_id');
    }

    // Relationship for students
    public function students()
    {
        return $this->belongsToMany(User::class, 'student_topics', 'st_topic_id', 'st_student_id')
                    ->withPivot('st_teacher_id');
    }
    // Relationship for teachers
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'student_topics', 'st_topic_id', 'st_teacher_id')
                    ->withPivot('st_student_id');
    }
}
