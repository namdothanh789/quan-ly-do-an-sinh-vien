<?php

namespace App\Helpers;

use App\Models\Student;
use App\Models\StudentTopic;
use App\Models\Calendar;
use App\Models\ResultFile;
use App\Models\Notification;

class PointCalculator
{
    public static function calculateTaskPoints($studentTopicId)
    {
        $calendars = Calendar::where('student_topic_id', $studentTopicId)->get();
        $totalTasks = $calendars->count();
        $completedTasks = $calendars->where('status', 2)->count();

        return $totalTasks > 0 ? 3 * ($completedTasks / $totalTasks) : 0;
    }

    public static function calculateReportPoints($studentTopicId)
    {
        $calendars = Calendar::with('resultFile')->where('student_topic_id', $studentTopicId)->get();
        $totalPoints = 0;
        $totalFiles = 0;

        foreach ($calendars as $calendar) {
          $resultFile = $calendar->resultFile;
          if ($resultFile && $resultFile->rf_point !== null) {
            $totalFiles++;
            $totalPoints += $resultFile->rf_point;
          }
        }

        return $totalFiles > 0 ? 3 * ($totalPoints / ($totalFiles * 10)) : 0;
    }

    public static function calculateInteractionPoints($studentTopicId)
    {
        $studentTopic = StudentTopic::with(['student.notifications'])->findOrFail($studentTopicId);
        //Lấy student có làm studentTopic
        $student = $studentTopic->student;
        //Đếm những thông báo được gửi đến student
        $totalMeetings = $student->notifications()->count();
        //Đếm những thông báo được gửi đến student và student đã xác nhận tham gia
        $confirmedMeetings = $student->notifications()->wherePivot('nu_status', 1)->count();
        //Đếm những thông báo được student gửi 
        $sentByStudentNotifications = $student->sentNotifications;
        if (isset($sentByStudentNotifications) && $sentByStudentNotifications->count() > 0 ){
          foreach($sentByStudentNotifications as $sentByStudentNotification){
            //chỉ tính những thông báo được gửi đến cho teacher
            $totalMeetings += $sentByStudentNotification->users()
                                                        ->wherePivot('nu_type_user', 1)
                                                        ->count();
            //chỉ tính những thông báo được gửi đến cho teacher và teacher đã xác nhận tham gia
            $confirmedMeetings += $sentByStudentNotification->users()
                                                            ->wherePivot('nu_type_user', 1)
                                                            ->wherePivot('nu_status', 1)
                                                            ->count();
          }
        }

        return $totalMeetings > 0 ? 3 * ($confirmedMeetings / $totalMeetings) : 0;
    }

    public static function calculateTotalPoints($studentTopicId)
    {
        $taskPoints = self::calculateTaskPoints($studentTopicId);
        $reportPoints = self::calculateReportPoints($studentTopicId);
        $interactionPoints = self::calculateInteractionPoints($studentTopicId);

        return ($taskPoints + $reportPoints + $interactionPoints) * 10 / 9;
    }
}
