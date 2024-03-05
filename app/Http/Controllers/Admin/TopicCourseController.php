<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Course;
use App\Models\Council;
use App\Models\User;
use App\Models\Department;
use App\Models\TopicCourse;
use App\Http\Requests\TopicCourseRequest;


class TopicCourseController extends Controller
{
    public function __construct(Topic $topic, Course $course, Council $council, User $user, Department $department)
    {
        view()->share([
            'topic_course_menu' => 'active',
            'topics' => $topic->where('t_status', 1)->get(),
            'courses' => $course->orderBy('id', 'DESC')->get(),
            'councils' => $council->where('co_status', 1)->get(),
            'teachers' => $user->where(['type' => User::TEACHER, 'status' => 1])->get(),
            'departments' => $department->getDepartments(),
            'status' => [1 => 'Đã duyệt', 2 => 'Chưa duyệt'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $topics = TopicCourse::with(['topic', 'course', 'council', 'department', 'teacher']);

        if ($request->tc_course_id) {
            $topics->where('tc_course_id', $request->tc_course_id);
        }

        if ($request->tc_department_id) {
            $topics->where('tc_department_id', $request->tc_department_id);
        }

        if ($request->tc_teacher_id) {
            $topics->where('tc_teacher_id', $request->tc_teacher_id);
        }

        if ($request->tc_status) {
            $topics->where('tc_status', $request->tc_status);
        }

        if (!empty($request->keyword)) {
            $keyword = $request->keyword;

            $topics->whereIn('tc_topic_id', function ($query) use ($keyword) {
                $query->select('id')->from('topics')->where('t_title', 'like', '%'. $keyword .'%');
            });
        }

        $topics = $topics->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.topic_course.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.topic_course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicCourseRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit');

            $councilId = $data['tc_course_id'];
            $course = Course::find($councilId);
            $data['tc_start_time'] = $course->c_start_time;
            $data['tc_end_time'] = $course->c_end_time;

            TopicCourse::create($data);
            \DB::commit();
            return redirect()->back()->with('success', 'Thêm mới thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $topicCourse = TopicCourse::findOrFail($id);

        if (!$topicCourse) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.topic_course.edit', compact('topicCourse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicCourseRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit');
            $councilId = $data['tc_course_id'];

            $course = Course::find($councilId);
            $data['tc_start_time'] = $course->c_start_time;
            $data['tc_end_time'] = $course->c_end_time;

            TopicCourse::find($id)->update($data);
            \DB::commit();
            return redirect()->back()->with('success', 'Chỉnh sửa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $topic = TopicCourse::find($id);
        if (!$topic) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $topic->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
