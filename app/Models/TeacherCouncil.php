<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCouncil extends Model
{
    use HasFactory;
    protected $table = 'teacher_councils';

    protected $fillable = [
        'tc_teacher_id', 'tc_council_id'
    ];

}