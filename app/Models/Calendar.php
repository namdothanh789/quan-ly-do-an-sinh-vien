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
        // 'file_result',
        'contents',
        'status',
        'created_at',
        'updated_at',
        'type'
    ];

    const STATUS = [
        0 => 'To do',
        1 => 'Đã nộp',
        2 => 'Hoàn thành',

    ];

    const CLASS_STATUS = [
        0 => 'btn-primary',
        1 => 'btn-secondary',
        2 => 'btn-success',
    ];

    const STUDENT_CLASS_STATUS = [
        0 => 'badge badge-pill bg-gradient-primary',
        1 => 'badge badge-pill bg-gradient-secondary',
        2 => 'badge badge-pill bg-gradient-success',
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

    public function resultFile()
    {
        return $this->hasOne(ResultFile::class);
    }
}
