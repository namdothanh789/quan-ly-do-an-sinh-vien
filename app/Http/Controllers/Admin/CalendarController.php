<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarRequest;
use App\Models\Calendar;
use App\Models\StudentTopic;
use App\Helpers\MailHelper;

class CalendarController extends Controller
{
    protected  $calendar;

    public function __construct(Calendar $calendar)
    {
        view()->share([
            'student_topics' => 'active',
            'status' => $calendar::STATUS,
            'classStatus' => $calendar::CLASS_STATUS,
        ]);
        $this->calendar = $calendar;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        $calendars = Calendar::where('student_topic_id', $id)->paginate(NUMBER_PAGINATION);
        $topic = StudentTopic::with(['topic' => function($query) {
            $query->with('topic');
        }, 'student'])->find($id);

        if (!$topic) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        $viewData = [
            'calendars' => $calendars,
            'student_topic_id' => $id,
            'topic' => $topic
        ];

        return view('admin.calendar.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $topic = StudentTopic::with(['topic' => function($query) {
            $query->with('topic');
        }, 'student'])->find($id);

        if (!$topic) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $viewData = [
            'student_topic_id' => $id,
            'topic' => $topic
        ];

        return view('admin.calendar.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->calendar->createOrUpdate($request);
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
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
        $calendar = Calendar::find($id);

        if (!$calendar) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $topic = StudentTopic::with(['topic' => function($query) {
            $query->with('topic');
        }, 'student'])->find($calendar->student_topic_id);

        if (!$topic) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $viewData = [
            'topic' => $topic,
            'calendar' => $calendar
        ];

        return view('admin.calendar.edit', $viewData);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalendarRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->calendar->createOrUpdate($request, $id);
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
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
        $calendar = Calendar::findOrFail($id);

        if (!$calendar) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $calendar->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $calendar = Calendar::findOrFail($id);

            if (!$calendar) {
                return response([
                    'code' => 404,
                    'message' => 'Không tìm thấy dữ liệu'
                ]);
            }
            return response([
                'code' => 200,
                'data' => $calendar,
                'message' => 'Thành công'
            ]);
        }
    }
}
