<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\User;
use App\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        view()->share([
            'group_active' => 'active',
            'students' => User::where('type', User::STUDENT)->get(),
        ]);
    }

    public function index()
    {
        //
        $groups = Group::with('studentGroups', 'user');

        $user = Auth::user();
        if ($user->hasRole(User::ROLE_USERS)) {
            $groups->where('user_id', $user->id);
        }

        $groups = $groups->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'students');
            $user = Auth::user();
            $data['user_id'] = $user->id;

            $group = Group::create($data);
            if (!empty($request->students)) {
                $group->studentGroups()->sync($request->students);
            }
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
        $group = Group::findOrFail($id);

        if (!$group) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        $studentGroup = GroupStudent::where('group_id', $id)->pluck('student_id')->toArray();

        return view('admin.group.edit', compact('group', 'studentGroup'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'students');

            $user = Auth::user();
            $data['user_id'] = $user->id;

            $group = Group::find($id);
            if (!empty($request->students)) {
                $group->studentGroups()->sync($request->students);
            }
            $group->update($data);
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
        $group = Group::find($id);
        if (!$group) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $group->studentGroups()->detach();
            $group->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

}
