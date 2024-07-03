<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentTopic;
use App\Models\Calendar;
use App\Helpers\PointCalculator;

class StudentPointsController extends Controller
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

        return view('page.points.index', compact('studentData'));
    }

    public function reportDetails($studentTopicId)
    {
        $calendars = Calendar::with(['resultFile' => function($query) {
            $query->whereNotNull('rf_point');
        }])
        ->whereHas('resultFile', function($query) {
            $query->whereNotNull('rf_point');
        })
        ->where('student_topic_id', $studentTopicId)
        ->orderByDesc('id')
        ->paginate(NUMBER_PAGINATION);
        return view('page.points.report_details', compact('calendars', 'studentTopicId'));
    }

    public function interactionDetails($studentTopicId)
    {
        $studentTopic = StudentTopic::with(['student.notifications', 'student.sentNotifications'])->findOrFail($studentTopicId);

        // Lấy student có làm studentTopic
        $student = $studentTopic->student;

        // Truy vấn và phân trang các notifications được gửi đến student
        $sentToStudentNotifications = $student->notifications()
            ->orderByDesc('notifications.id')
            ->paginate(NUMBER_PAGINATION);
        // Truy vấn và phân trang các notifications do student gửi
        $studentSentConfirmedNotifications = $student->sentNotifications()
            ->with(['users' => function($query) {
                $query->where('notification_users.nu_type_user', 1)
                ->where('notification_users.nu_status', 1);; // teacher đã xác nhận tham gia
            }])
            ->whereHas('users', function($query) {
                $query->where('notification_users.nu_type_user', 1)
                ->where('notification_users.nu_status', 1); // teacher đã xác nhận tham gia
            })
            ->orderByDesc('notifications.id')
            ->paginate(NUMBER_PAGINATION);
        $studentSentConfirmedNotNotifications = $student->sentNotifications()
        ->with(['users' => function($query) {
            $query->where('notification_users.nu_type_user', 1)
            ->where('notification_users.nu_status', 2);; // teacher đã xác nhận tham gia
        }])
        ->whereHas('users', function($query) {
            $query->where('notification_users.nu_type_user', 1)
            ->where('notification_users.nu_status', 2); // teacher đã xác nhận tham gia
        })
        ->orderByDesc('notifications.id')
        ->paginate(NUMBER_PAGINATION);
        return view('page.points.interaction_details', compact('sentToStudentNotifications', 'studentSentConfirmedNotifications', 'studentSentConfirmedNotNotifications', 'studentTopicId'));
    }
}
