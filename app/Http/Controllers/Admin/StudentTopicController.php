<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Course;
use App\Models\User;
use App\Models\StudentTopic;
use App\Models\ResultFile;
use App\Http\Requests\UpdateOutlineRequest;
use App\Http\Requests\UpdateThesisBookRequest;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Auth;

class StudentTopicController extends Controller
{
    //
    public function __construct(Department $department, Course $course, User $user)
    {
        view()->share([
            'student_topics' => 'active',
            'departments' => $department->getDepartments(),
            'courses' => $course->orderBy('id', 'DESC')->get(),
            'teachers' => $user->where(['type' => User::TEACHER, 'status' => 1])->get(),
            // 'status_outline' => StudentTopic::STATUS_OUTLINE,
            // 'status' => StudentTopic::STATUS,
        ]);
    }

    public function index(Request $request)
    {
        $studentTopics = StudentTopic::with(['student', 'topic' => function($topic) {
            $topic->with(['topic', 'department']);
        }, 'teacher', 'course']);

        //search by student code
        if ($request->code) {
            $code = $request->code;
            $studentTopics->whereIn('st_student_id', function ($query) use ($code) {
                $query->select('id')->from('users')->where('code', 'like', '%'. $code . '%');
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
        //filter by id of login teacher
        $user = Auth::user();
        $studentTopics->where('st_teacher_id', $user->id);

        $studentTopics = $studentTopics->orderByDesc('id')->paginate(NUMBER_PAGINATION);

        $viewData = [
            'studentTopics' => $studentTopics,
        ];

        return view('admin.student_topic.index', $viewData);
    }

    public function edit($id)
    {
        $student = StudentTopic::with(['student', 'topic' => function($topic) {
            $topic->with(['topic', 'department']);
        }, 'teacher'])->find($id);


        if (!$student) {
            return redirect()->route('student.topics.index')->with('danger', 'Dữ liệu không tồn tại');
        }
        return view('admin.student_topic.edit', compact('student'));

    }

    public function updateOutline(UpdateOutlineRequest $request, $id)
    {
        $user = Auth::user();

        $student = StudentTopic::with(['student', 'topic' => function($topic) {
            $topic->with(['topic', 'department']);
        }, 'teacher'])->find($id);

        if (!$student) {
            return redirect()->back()->with('danger', 'Dữ liệu không tồn tại');
        }

        $result_file = ResultFile::where('id', $request->result_outline_file_id)->first();

        if (!$result_file) {
            return redirect()->back()->with('danger', 'Dữ liệu không tồn tại');
        }

        $attributes = $request->except('outline_part', 'outline', '_token', 'result_outline_file_id', 'rf_point', 'rf_comment');

        if($request->hasfile('outline_part'))
        {
            $file = $request->file('outline_part');

            $part_file_feedback = date('YmdHms').'-'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/documents/', date('YmdHms').$file->getClientOriginalName());

            $attributes['rf_part_file_feedback'] = $part_file_feedback;
        }

        if ($request->rf_point) {
            $attributes['rf_point'] = $request->rf_point;
        }

        if ($request->rf_comment) {
            $attributes['rf_comment'] = $request->rf_comment;
        }


        \DB::beginTransaction();
        try {
            if ($result_file->update($attributes)) {

                $outline = ['st_status_outline' => $result_file->rf_status];
                if ($result_file->rf_status == 2) {
                    $outline['st_point_outline'] = $result_file->rf_point;
                } else if ($result_file->rf_status == 3) {
                    $outline['st_point_outline'] = 0;
                }
                $student->update($outline);

                $status = StudentTopic::STATUS_OUTLINE;
                if ($student->st_status_outline) {
                    $dataMail = [
                        'subject' => 'Giáo viên hướng dẫn đã phản hồi đề cương của bạn',
                        'name_teacher' => $user->name,
                        'name_student' => isset($student->student) ? $student->student->name : '',
                        'email' => isset($student->student) ? $student->student->email : '',
                        'topic' => $student->topic->topic->t_title,
                        'title' => $result_file->rf_title,
                        'link_download' => $result_file->rf_part_file_feedback,
                        'comments' => $result_file->rf_comment,
                        'status' => isset($status[$student->st_status_outline]) ? $status[$student->st_status_outline] : '',
                        'point'  => $result_file->rf_point,
                        'outline_status' => 1, //1 là đề cương, 0 là đồ án
                        'teacher_status' => 1
                    ];

                    MailHelper::sendMailOutline($dataMail);
                }
            }
            \DB::commit();
            return redirect()->back()->with('success','Cập nhật thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    public function updateThesisBook(UpdateThesisBookRequest $request, $id)
    {
        $user = Auth::user();
        $student = StudentTopic::with(['student', 'topic' => function($topic) {
            $topic->with(['topic', 'department']);
        }, 'teacher'])->find($id);

        if (!$student) {
            return redirect()->back()->with('danger', 'Dữ liệu không tồn tại');
        }

        $result_file = ResultFile::where('id', $request->result_book_file_id)->first();

        if (!$result_file) {
            return redirect()->back()->with('danger', 'Dữ liệu không tồn tại');
        }

        $attributes = $request->except('outline_part', 'outline', '_token', 'result_outline_file_id', 'rf_point', 'rf_comment');


        if($request->hasfile('thesis_book_part'))
        {
            $file = $request->file('thesis_book_part');

            $part_file_feedback = date('YmdHms').'-'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/documents/', date('YmdHms').$file->getClientOriginalName());

            $attributes['rf_part_file_feedback'] = $part_file_feedback;
        }

        if ($request->rf_point) {
            $attributes['rf_point'] = $request->rf_point;
        }

        if ($request->rf_comment) {
            $attributes['rf_comment'] = $request->rf_comment;
        }
        
        \DB::beginTransaction();
        try {
            if ($result_file->update($attributes)) {

                $outline = ['st_status_thesis_book' => $result_file->rf_status];
                if ($result_file->rf_status == 2) {
                    $outline['st_point_thesis_book'] = $result_file->rf_point;
                } else if ($result_file->rf_status == 3) {
                    $outline['st_point_thesis_book'] = 0;
                }
                $student->update($outline);

                $status = StudentTopic::STATUS_OUTLINE;
                if ($student->st_status_thesis_book) {
                    $dataMail = [
                        'subject' => 'Giáo viên hướng dẫn đã phản hồi đồ án của bạn',
                        'name_teacher' => $user->name,
                        'name_student' => isset($student->student) ? $student->student->name : '',
                        'email' => isset($student->student) ? $student->student->email : '',
                        'topic' => $student->topic->topic->t_title,
                        'title' => $result_file->rf_title,
                        'link_download' => $result_file->rf_part_file_feedback,
                        'comments' => $result_file->rf_comment,
                        'status' => isset($status[$student->st_status_thesis_book]) ? $status[$student->st_status_thesis_book] : '',
                        'point'  => $result_file->rf_point,
                        'outline_status' => 0, //1 là đề cương, 0 là đồ án
                        'teacher_status' => 1
                    ];

                    MailHelper::sendMailOutline($dataMail);
                }
            }
            \DB::commit();
            return redirect()->back()->with('success','Cập nhật thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    public function updateStudentTopic(Request $request, $id)
    {
        $attributes = $request->except('_token');
        $user = Auth::user();

        $student = StudentTopic::with(['student', 'topic' => function($topic) {
            $topic->with(['topic', 'department']);
        }, 'teacher'])->find($id);

        \DB::beginTransaction();
        try {
            if ($student->update($attributes)) {
                $status = StudentTopic::STATUS;
                if ($student->st_status) {
                    $dataMail = [
                        'subject' => 'Thông báo kết quả và đánh giá đề tài đồ án',
                        'name_teacher' => $user->name,
                        'name_student' => isset($student->student) ? $student->student->name : '',
                        'email' => isset($student->student) ? $student->student->email : '',
                        'topic' => $student->topic->topic->t_title,
                        'title' => $student->st_thesis_book,
                        'link_download' => '',
                        'comments' => $student->st_comments,
                        'status' => isset($status[$student->st_status]) ? $status[$student->st_status] : '',
                        'point'  => $student->st_point,
                        'outline_status' => 0,
                        'teacher_status' => 1,
                        'topic' => 1
                    ];

                    MailHelper::sendMailOutline($dataMail);
                }
            }
            \DB::commit();
            return redirect()->back()->with('success','Cập nhật thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }

    }

    public function delete($id)
    {
        $student = StudentTopic::find($id);

        if (!$student) {
            return redirect()->back()->with('danger', 'Dữ liệu không tồn tại');
        }
        \DB::beginTransaction();
        try {
            $student->delete();
            \DB::commit();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function viewFileReport(Request $request, $id)
    {
        $student = StudentTopic::with(['student', 'topic' => function($topic) {
            $topic->with(['topic', 'department']);
        }, 'teacher'])->find($id);

        $type = $request->type ?? 1;
        $result_files = ResultFile::where(['rf_student_topic_id' => $id, 'rf_type' => $type])->get();

        return view('admin.student_topic.view_files', compact('result_files', 'type', 'student'));
    }
}
