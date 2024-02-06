<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    use HasFactory;
    protected $table = 'councils';

    protected $fillable = [
        'co_title', 'co_content', 'co_course_id', 'co_status', 'created_at','updated_at'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'co_course_id');
    }

    public function teacherCouncils()
    {
        return $this->belongsToMany(User::class, 'teacher_councils', 'tc_council_id', 'tc_teacher_id');
    }
}
