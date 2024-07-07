<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ResultFileUploadTrait;
use Illuminate\Support\Facades\Log;
class Calendar extends Model
{
    use ResultFileUploadTrait;
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
        0 => 'badge badge-lg badge-pill bg-gradient-primary',
        1 => 'badge badge-lg badge-pill bg-gradient-info',
        2 => 'badge badge-lg badge-pill bg-gradient-success',
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
        $params = $request->except(['_token']);

        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }

    public function resultFile()
    {
        return $this->hasOne(ResultFile::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($calendar) {
            if ($calendar->resultFile) {
                try {
                    $calendar->deleteResultFile($calendar->resultFile->rf_path);
                    $calendar->resultFile->delete();
                } catch (\Exception $e) {
                    \Log::error('Failed to delete result file: ' . $e->getMessage());
                }
            }
        });
    }
}
