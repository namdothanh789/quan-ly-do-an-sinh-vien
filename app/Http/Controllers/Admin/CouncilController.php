<?php

namespace App\Http\Controllers\Admin;

use App\Models\Council;
use App\Models\Course;
use App\Models\User;
use App\Models\TeacherCouncil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouncilRequest;
use App\Helpers\MailHelper;

class CouncilController extends Controller
{
    public function __construct(Course $course, User $user)
    {
        view()->share([
            'council_menu' => 'active',
            'status' => [1 => 'Đã duyệt', 2 => 'Chưa duyệt'],
            'courses' => $course->orderBy('id', 'DESC')->get(),
            'teachers' => $user->where('type', User::TEACHER)->get(),
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
        $councils = Council::with(['course']);
        $councils = $councils->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.council.index', compact('councils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.council.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouncilRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'teachers');
            $council = Council::create($data);
            if (!empty($request->teachers)) {
                $council->teacherCouncils()->sync($request->teachers);
                if ($request->co_status == 1) {
                    $users = User::whereIn('id', $request->teachers)->get();
                    foreach ($users as $user) {
                        $dataMail = [
                            'name' => $user->name,
                            'email' => $user->email,
                            'subject' => 'Thành lập hội đồng '. $data['co_title'],
                            'content' => $data['co_content'],
                        ];
                        MailHelper::sendMailCouncil($dataMail);
                    }
                }
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
        $council = Council::findOrFail($id);

        if (!$council) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        $teacherCouncils = TeacherCouncil::where('tc_council_id', $id)->pluck('tc_teacher_id')->toArray();

        return view('admin.council.edit', compact('council', 'teacherCouncils'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouncilRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $data = $request->except('_token', 'submit', 'teachers');
            $council = Council::find($id);
            if (!empty($request->teachers)) {
                $council->teacherCouncils()->sync($request->teachers);
                if ($request->co_status == 1) {
                    $users = User::whereIn('id', $request->teachers)->get();
                    foreach ($users as $user) {
                        $dataMail = [
                            'name' => $user->name,
                            'email' => $user->email,
                            'subject' => 'Thành lập hội đồng '. $data['co_title'],
                            'content' => $data['co_content'],
                        ];
                        MailHelper::sendMailCouncil($dataMail);
                    }
                }
            }
            $council->update($data);
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
        $council = Council::find($id);
        if (!$council) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $council->teacherCouncils()->detach();
            $council->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
