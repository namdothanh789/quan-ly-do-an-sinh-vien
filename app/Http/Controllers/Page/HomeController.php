<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TopicCourse;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Department;

class HomeController extends Controller
{
    //
    public function index()
    {
        // lấy thông tin sinh viên
        $user = Auth::guard('students')->user();
        // lấy danh sách đề tài thuộc khoa và kỳ học
        $topics = TopicCourse::with(['topic', 'course', 'council', 'department', 'teacher', 'studentTopics'])
            ->where(['tc_course_id' => $user->course_id, 'tc_department_id' => $user->department_id, 'tc_status' => 1])->get();
        $course = Course::find($user->course_id);
        $department = Department::with('parent')->find($user->department_id);

        $viewData = [
            'topics' => $topics,
            'course' => $course,
            'department' => $department,
        ];
        return view('page.home.index', $viewData);
    }

    public function about()
    {
        return view('page.about.index');
    }
}
