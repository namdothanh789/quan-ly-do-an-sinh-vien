<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{
    use HasFactory;
    protected $table = 'group_students';

    public function student()
    {
        return $this->hasOne(User::class, 'student_id', 'id');
    }
}
