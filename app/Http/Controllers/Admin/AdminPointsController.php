<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentTopic;
use App\Models\Calendar;
use App\Models\ResultFile;
use App\Models\Notification;
use App\Helpers\PointCalculator;

class AdminPointsController extends Controller
{
    public function index($studentTopicId)
    {
        $studentTopic = StudentTopic::with('student')->findOrFail($studentTopicId);
        $student = $studentTopic->student;
        $taskPoints = PointCalculator::calculateTaskPoints($studentTopicId);
        $reportPoints = PointCalculator::calculateReportPoints($studentTopicId);
        $interactionPoints = PointCalculator::calculateInteractionPoints($studentTopicId);
        $totalPoints = PointCalculator::calculateTotalPoints($studentTopicId);

        $studentData = [
            'studentTopicId' => $studentTopicId,
            'student' => $student,
            'task_points' => $taskPoints,
            'report_points' => $reportPoints,
            'interaction_points' => $interactionPoints,
            'total_points' => $totalPoints
        ];

        return view('admin.points.index', compact('studentData'));
    }

    public function reportDetails($studentTopicId)
    {
        $calendars = Calendar::with('resultFile')->where('student_topic_id', $studentTopicId)->get();
        $resultFiles = []; //list of result files
        foreach ($calendars as $calendar) {
            $resultFile = $calendar->resultFile;
            if ($resultFile && $resultFile->point !== null) {
                $resultFiles[] = $resultFile;
            }
        }
        $resultFiles = collect($resultFiles)->paginate(1);
        return view('admin.points.report_details', compact('resultFiles'));
    }

    public function interactionDetails($studentTopicId)
    {
        $studentTopic = StudentTopic::with(['student.notifications'])->findOrFail($studentTopicId);
        $notifications = []; //list of notifications, notifications equal to meetings
        $confirmedNotifications = []; //list of confirmedNotifications, confirmedNotifications equal to confirmedMeetings
        //Lấy student
        $student = $studentTopic->student;
        //Lấy tất cả những thông báo được gửi đến student
        $notifications = array_merge($notifications, $student->notifications->toArray());
        //Lấy tất cả những thông báo được gửi đến student và student đã xác nhận tham gia
        $confirmedNotifications = array_merge($notifications, $student->notifications()
                                                                     ->wherePivot('nu_status', 1)
                                                                     ->get()->toArray());
        //Lấy những thông báo được student gửi
        $sentByStudentNotifications = $student->sentNotifications;
        if (isset($sentByStudentNotifications) && $sentByStudentNotifications->count() > 0 ) {
            foreach($sentByStudentNotifications as $sentByStudentNotification) {
                //Lấy những thông báo được student gửi cho teacher
                $notifications = array_merge($notifications, $sentByStudentNotification->users()
                                                                                       ->wherePivot('nu_type_user', 1)
                                                                                       ->get()->toArray());
                //Lấy những thông báo được student gửi cho teacher và teacher đã xác nhận tham gia
                $confirmedNotifications = array_merge($notifications, $sentByStudentNotification->users()
                                                                                               ->wherePivot('nu_type_user', 1)
                                                                                               ->wherePivot('nu_status', 1)
                                                                                               ->get()->toArray());
            }
        }
        
        $notifications = collect($notifications)->paginate(1);
        $confirmedNotifications = collect($confirmedNotifications)->paginate(1);

        return view('admin.points.interaction_details', compact('notifications', 'confirmedNotifications'));
    }
}
