<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $table = 'topics';

    protected $fillable = [
        't_title', 't_registration_number', 't_department_id', 't_content', 't_status', 'created_at','updated_at'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 't_department_id', 'id');
    }

    // Relationship for students
    // public function students()
    // {
    //     return $this->belongsToMany(User::class, 'student_topics', 'st_topic_id', 'st_student_id')
    //                 ->withPivot('st_teacher_id');
    // }

    // Relationship for teachers
    // public function teachers()
    // {
    //     return $this->belongsToMany(User::class, 'student_topics', 'st_topic_id', 'st_teacher_id')
    //                 ->withPivot('st_student_id');
    // }
}
