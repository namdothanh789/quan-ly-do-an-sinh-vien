<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\User;
use App\Models\Department;
use App\Models\Course;

class StudentController extends Controller
{
    //
    public function __construct(Department $department, Course $course)
    {
        view()->share([
            'student_active' => 'active',
            'departments' => $department->getDepartments(),
            'courses' => $course->orderBy('id', 'DESC')->get(),
            'gender' => User::GENDER,
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
        $students = User::with(['course', 'department']);

        if ($request->name) {
            $students->where('name', 'like', '%'.$request->name.'%');
        }

        if ($request->phone) {
            $students->where('phone', $request->phone);
        }

        if ($request->email) {
            $students->where('email', $request->email);
        }

        if ($request->position_id) {
            $students->where('course_id', $request->position_id);
        }

        if ($request->department_id) {
            $students->where('department_id', $request->department_id);
        }

        if ($request->status) {
            $students->where('status', $request->status);
        }

        $students = $students->where('type', User::STUDENT)->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);
        return view('admin.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $data = $request->except('images', 'role', 'submit', 'password', '_token');
        //
        \DB::beginTransaction();
        try {
            $data['password'] = bcrypt($request->password);
            $data['type'] = User::STUDENT;

            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $data['avatar'] = $image['name'];
            }

            $userId = User::insertGetId($data);
            if ($userId) {
                \DB::table('role_user')->insert(['role_id'=> User::ROLE_STUDENT, 'user_id'=> $userId]);
            }

            \DB::commit();
            return redirect()->back()->with('success','Thêm mới thành công');
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
        $user = User::find($id);
        if(!$user) {
            return redirect()->route('get.list.user')->with('danger', 'Quyền không tồn tại');
        }

        $viewData = ['user' => $user];
        return view('admin.student.create', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        //
        $data = $request->except('images', 'role', 'submit', 'password', '_token');
//
        \DB::beginTransaction();
        try {
            $user = User::find($id);
            $data['type'] = User::STUDENT;

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $user->avatar = $image['name'];
            }
            $user->update($data);
            \DB::commit();
            return redirect()->back()->with('success','Chỉnh sửa thành công');
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
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        \DB::beginTransaction();
        try {
            $user->delete();
            \DB::commit();
            return redirect()->back()->with('success','Đã xóa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }
}
