<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultFile extends Model
{
    use HasFactory;

    protected $table = 'result_files';
    protected $fillable = [
        'rf_student_topic_id',
        'rf_title',
        'rf_part_file',
        'rf_part_file_feedback',
        'rf_comment',
        'rf_point',
        'rf_status',
        'rf_type',
        'created_at',
        'updated_at'
    ];

}
