<?php

namespace App\Http\Controllers\Admin;

use App\Models\Topic;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;

class TopicController extends Controller
{
    public function __construct(Department $department)
    {
        view()->share([
            'topic_menu' => 'active',
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
        $topics = Topic::with(['department']);

        if ($request->t_title) {
            $topics->where('t_title', 'like', '%'.$request->t_title.'%');
        }

        if ($request->t_department_id) {
            $topics->where('t_department_id', $request->t_department_id );
        }

        if ($request->t_status) {
            $topics->where('t_status', $request->t_status);
        }
        $topics = $topics->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit');
            Topic::create($data);
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
        $topic = Topic::findOrFail($id);

        if (!$topic) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.topic.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit');
            Topic::find($id)->update($data);
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
        $topic = Topic::find($id);
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
