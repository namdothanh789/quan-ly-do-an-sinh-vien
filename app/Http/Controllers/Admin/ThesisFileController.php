<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentTopic;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\User;
use App\Models\ResultFile;
use Illuminate\Support\Facades\Auth;

class ThesisFileController extends Controller
{
    public function __construct(Department $department, Course $course)
    {
        view()->share([
            'thesisFile_active' => 'active',
            'departments' => $department->getDepartments(),
            'courses' => $course->orderBy('id', 'DESC')->get(),
        ]);
    }

    public function thesisFileIndex(Request $request)
    {
        //filter by id of login teacher
        $user = Auth::user();
        $studentTopics = StudentTopic::where('st_teacher_id', $user->id)
        ->whereHas('calendars.resultFile', function ($query) {
            $query->where('rf_type', 1);
        })
        ->with(['student', 'topic' => function($topic) {
            $topic->with(['topic', 'department']);
        }, 'course', 'calendars' => function($calendars) {
            $calendars->with('resultFile')->whereHas('resultFile', function($query) {
                $query->where('rf_type', 1);
            });
        }]);
        //search by file name
        if ($request->fileName) {
            $fileName = $request->fileName;
            $studentTopics->whereHas('calendars.resultFile', function ($query) use ($fileName) {
                $query->where('rf_title', 'like', '%' . $fileName . '%')
                      ->where('rf_type', 1);
            });
        }
        //search by student name
        if ($request->name) {
            $name = $request->name;
            $studentTopics->whereIn('st_student_id', function ($query) use ($name) {
                $query->select('id')->from('users')->where('name', 'like', '%'.$name.'%');
            });
        }
        //search by course
        if ($request->tc_course_id) {
            $studentTopics->where('st_course_id', $request->tc_course_id);
        }
        $studentTopics = $studentTopics->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        $viewData = [
            'studentTopics' => $studentTopics,
        ];
        return view('admin.thesis_file.index', $viewData);
    }
}
