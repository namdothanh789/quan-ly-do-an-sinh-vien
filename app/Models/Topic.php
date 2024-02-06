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
}
