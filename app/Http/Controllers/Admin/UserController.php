<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ChangePasswordAdminRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(Role $role, Position $position, Department $department)
    {
        view()->share([
            'user_active' => 'active',
            'roles' => $role->all(),
            'positions' => $position->all(),
            'departments' => $department->all(),
            'gender' => User::GENDER,
            'status' => User::STATUS,
            'roleStudent' => User::ROLE_STUDENT,
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
        $users = User::with([
            'userRole' => function($userRole)
            {
                $userRole->select('*');
            },
            'position', 'department'
        ]);

        if ($request->name) {
            $users->where('name', 'like', '%'.$request->name.'%');
        }

        if ($request->phone) {
            $users->where('phone', $request->phone);
        }

        if ($request->email) {
            $users->where('email', $request->email);
        }

        if ($request->position_id) {
            $users->where('position_id', $request->position_id);
        }

        if ($request->department_id) {
            $users->where('department_id', $request->department_id);
        }

        if ($request->status) {
            $users->where('status', $request->status);
        }

        $users = $users->where('type', User::TEACHER)->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('images', 'role', 'submit', 'password', '_token');

        \DB::beginTransaction();
        try {

            $data['password'] = bcrypt($request->password);
            $data['type'] = User::TEACHER;
            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $data['avatar'] = $image['name'];
            }
            $userId = User::insertGetId($data);
            if ($userId) {
                \DB::table('role_user')->insert(['role_id'=> $request->role, 'user_id'=> $userId]);
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
        $user = User::with([
            'userRole' => function($userRole)
            {
                $userRole->select('*');
            }
        ])->find($id);
        $listRoleUser = \DB::table('role_user')->where('user_id', $id)->first();
        if(!$user) {
            return redirect()->route('get.list.user')->with('danger', 'Quyền không tồn tại');
        }

        $viewData = [
            'user' => $user,
            'listRoleUser' => $listRoleUser
        ];
        return view('admin.user.create', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except('images', 'role', 'submit', 'password', '_token');
        //
        \DB::beginTransaction();
        try {

            $user = User::find($id);
            $data['type'] = User::TEACHER;

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $user->avatar = $image['name'];
            }

            if ($user->update($data)) {
                \DB::table('role_user')->where('user_id', $id)->delete();
                \DB::table('role_user')->insert(['role_id'=> $request->role, 'user_id'=> $user->id]);
            }

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

    public function changePassword()
    {
        return view('admin.auth.change');
    }

    public function postChangePassword(ChangePasswordAdminRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user =  User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            \DB::commit();
            Auth::logout();
            return redirect()->route('admin.login')->with('success', 'Đổi mật khẩu thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể đổi mật khẩu');
        }
    }
}
