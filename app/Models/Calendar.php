<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendars';

    protected $fillable = [
        'student_topic_id',
        'title',
        'start_date',
        'end_date',
        'file_result',
        'contents',
        'status',
        'created_at',
        'updated_at'
    ];

    const STATUS = [
        0 => 'To do',
        1 => 'Hoàn thành',
        2 => 'Bị chậm',
        3 => 'Yc Làm lại',
        4 => 'Đã nộp',

    ];

    const CLASS_STATUS = [
        0 => 'btn-secondary',
        1 => 'btn-success',
        2 => 'btn-warning',
        3 => 'btn-danger',
        4 => 'btn-primary',
    ];

    public function studentTopic()
    {
        return $this->belongsTo(StudentTopic::class, 'student_topic_id');
    }

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'images']);

        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
