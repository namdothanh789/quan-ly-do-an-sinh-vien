<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'name', 'status', 'user_id', 'created_at','updated_at'
    ];

    public function students()
    {
        return $this->hasMany(Group::class, 'group_id', 'id');
    }

    public function studentGroups()
    {
        return $this->belongsToMany(User::class, 'group_students', 'group_id', 'student_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
