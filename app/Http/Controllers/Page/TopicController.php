<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TopicCourse;
use App\Models\StudentTopic;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Log;

class TopicController extends Controller
{

    public function index(Request $request, $id)
    {
        $topic = TopicCourse::with(['topic', 'course', 'council', 'department', 'teacher', 'studentTopics' => function ($students) {
            $students->with('students', 'result_outline_files', 'result_book_files');
        }])->where(['id' => $id])->first();

        if (!$topic) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('page.topic.index', compact('topic'));
    }

    public function registerTopic($id)
    {
        $user = Auth::guard('students')->user();
        $topic = TopicCourse::with(['topic', 'course', 'council', 'department', 'teacher', 'studentTopics'])->where(['id' => $id])->first();

        $param = [
            'st_student_id' => $user->id,
            'st_topic_id' => $topic->id,
            'st_teacher_id' => $topic->tc_teacher_id,
            'st_course_id' => $topic->tc_course_id,
        ];

        $studentTopic = StudentTopic::where($param)->first();

        if ($studentTopic) {
            return response([
                'code' => 0,
                'message' => 'Bạn đã đăng ký đề tài.'
            ]);
        }

        if (!$topic) {
            return response([
                'code' => 0,
                'message' => 'Đã xảy ra lỗi không thể đăng ký đề tài.'
            ]);
        }

        if (!checkInTime($topic->tc_start_time, $topic->tc_end_time)) {
            return response([
                'code' => 0,
                'message' => 'Thời gian đăng ký đề tài đã kết thúc.'
            ]);
        }

        if ($topic->studentTopics->count() >= $topic->tc_registration_number ) {
            return response([
                'code' => 0,
                'message' => 'Số lượng sinh viên đăng ký đề tài đã đầy'
            ]);
        }

        \DB::beginTransaction();
        try {
            $studentTopic = StudentTopic::insert($param);

            if ($studentTopic) {
                // send mail student and teacher
                $dataMail = [
                    'subject' => 'Thông báo sinh viên ' .$user->name . ' đã đăng ký đề tài',
                    'name_teacher' => isset($topic->teacher) ? $topic->teacher->name : '',
                    'name_student' => $user->name,
                    'email' => isset($topic->teacher) ? $topic->teacher->email : '',
                    'topic' => $topic->topic->t_title,
                    'start_outline' => $topic->tc_start_outline,
                    'end_outline' => $topic->tc_end_outline,
                    'start_thesis_book' => $topic->tc_start_thesis_book,
                    'end_thesis_book' => $topic->tc_end_thesis_book,
                    'council' => $topic->council->co_title,
                ];
                MailHelper::sendMailRegisterTopic($dataMail);
            }

            \DB::commit();
            return response([
                'code' => 1,
                'message' => 'Đăng ký thành công đề tài'
            ]);
        } catch (\Exception $exception) {
            \DB::rollBack();
            Log::warning($exception->getMessage());
            return response([
                'code' => 0,
                'message' => 'Đã xảy ra lỗi không thể đăng ký đề tài'
            ]);
        }

    }

    public function topicRegisters()
    {
        // lấy thông tin sinh viên
        $user = Auth::guard('students')->user();
        // lấy danh sách đề tài thuộc khoa và kỳ học
        $topics = TopicCourse::with(['topic', 'course', 'council', 'department', 'teacher', 'studentTopics' => function ($students) {
            $students->with('students', 'result_outline_files');
        }])->where(['tc_course_id' => $user->course_id, 'tc_department_id' => $user->department_id, 'tc_status' => 1])->get();

        return view('page.topic.register_result', compact('topics'));
    }
}