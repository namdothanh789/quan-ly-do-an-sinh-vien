<?php


namespace App\Http\Controllers\Page;

use App\Http\Requests\ResultFileRequest;
use App\Traits\ResultFileUploadTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentTopic;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserUpdateInforProfileRequest;
use App\Http\Requests\OutlineRequest;
use App\Http\Requests\ThesisBookRequest;
use App\Helpers\MailHelper;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Calendar;
use App\Models\ResultFile;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ResultFileUploadTrait;
    public function __construct()
    {
        view()->share([
            'gender' => User::GENDER,
            // 'status_outline' => StudentTopic::STATUS_OUTLINE,
            // 'status' => StudentTopic::STATUS
        ]);
    }
    //
    public function profile()
    {
        $user = Auth::guard('students')->user();
        return view('page.user.index', compact('user'));
    }

    public function updateProfile(UserUpdateInforProfileRequest $request)
    {
        $data = $request->except('images', '_token');

        \DB::beginTransaction();
        try {
            $id = Auth::guard('students')->user()->id;

            $user = User::find($id);

            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $user->avatar = $image['name'];
            }

            $user->update($data);
            \DB::commit();
            return redirect()->route('user.profile')->with('success','Chỉnh sửa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->route('user.profile')->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    public function registerDetails()
    {
        $user = Auth::guard('students')->user();

        $param = [
            'st_student_id' => $user->id,
            'st_course_id' => $user->course_id
        ];
        $studentTopic = StudentTopic::with(['topic' => function($topic) {
            $topic->with(['topic', 'department']);
        }, 'teacher'])->where($param)->first();

        if (!$studentTopic)
        {
            return redirect()->back()->with('error', 'Chưa đăng ký đề tài');
        }

        $numberStudent = 0;
        if ($studentTopic) {
            $numberStudent = StudentTopic::where(['st_course_id' =>  $user->course_id, 'st_topic_id' => $studentTopic->st_topic_id])->count();
        }

        return view('page.topic.register_details', compact('studentTopic', 'numberStudent'));
    }

    // public function outline()
    // {
    //     $user = Auth::guard('students')->user();

    //     $param = [
    //         'st_student_id' => $user->id,
    //         'st_course_id' => $user->course_id
    //     ];
    //     $studentTopic = StudentTopic::with(['topic' => function($topic) {
    //         $topic->with(['topic', 'department']);
    //     }, 'teacher'])->where($param)->first();

    //     $result_files = ResultFile::where(['rf_student_topic_id' => $studentTopic->id, 'rf_type' => 1])->get();

    //     return view('page.topic.outline', compact('studentTopic', 'result_files'));


    // }

//     public function postOutline(OutlineRequest $request, $id)
//     {
//         $user = Auth::guard('students')->user();

//         $studentTopic = StudentTopic::with(['teacher', 'topic' => function ($topic) {
//             $topic->with('topic');
//         }])->find($id);

//         if (!$studentTopic) {
//             return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể nộp đề cương');
//         }
//         if (!checkInTime($studentTopic->topic->tc_start_outline, $studentTopic->topic->tc_end_outline)) {
//             return redirect()->back()->with('error', 'Hết thời gian nộp đề cương');
//         }
//         try {
//             if($request->hasfile('outline_part'))
//             {
//                 $file = $request->file('outline_part');
//                 $st_outline_part = date('YmdHms').'-'. $user->code .'-'.$file->getClientOriginalName();
//                 $file->move(public_path().'/uploads/documents/', date('YmdHms'). $user->code .$file->getClientOriginalName());
//             }

//             $data = [
//                 'rf_student_topic_id' => $studentTopic->id,
//                 'rf_title' => $request->st_outline,
//                 'rf_part_file' => $st_outline_part,
//                 'rf_status' => 1,
//                 'rf_type' => 1,
//             ];

// //            $studentTopic->st_outline = $request->st_outline;
// //            $studentTopic->st_outline_part = $st_outline_part;
//             $studentTopic->st_status_outline = 1; //đã nộp

//             if (ResultFile::create($data)) {
//                 // send mail teacher
//                 $dataMail = [
//                     'subject' => 'Thông báo sinh viên ' .$user->name . ' đã nộp file đề cương',
//                     'name_teacher' => isset($studentTopic->teacher) ? $studentTopic->teacher->name : '',
//                     'name_student' => $user->name,
//                     'email' => isset($studentTopic->teacher) ? $studentTopic->teacher->email : '',
//                     'topic' => $studentTopic->topic->topic->t_title,
//                     'title' => $request->st_outline,
//                     'link_download' => $st_outline_part,
//                     'status' => 'Đã nộp',
//                     'outline_status' => 1, //1 là đề cương, 0 là đồ án
//                     'teacher_status' => 0
//                 ];

//                 MailHelper::sendMailOutline($dataMail);
//             }
//             return redirect()->back()->with('success','Nộp thành công đề cương ');
//         } catch (\Exception $exception) {
//             return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể nộp đề cương');
//         }

//     }


    // public function thesisBook()
    // {
    //     $user = Auth::guard('students')->user();

    //     $param = [
    //         'st_student_id' => $user->id,
    //         'st_course_id' => $user->course_id
    //     ];
    //     $studentTopic = StudentTopic::with(['topic' => function($topic) {
    //         $topic->with(['topic', 'department']);
    //     }, 'teacher'])->where($param)->first();

    //     $result_files = ResultFile::where(['rf_student_topic_id' => $studentTopic->id, 'rf_type' => 2])->get();

    //     return view('page.topic.thesis_book', compact('studentTopic', 'result_files'));
    // }

//     public function postThesisBook(ThesisBookRequest $request, $id)
//     {
//         $user = Auth::guard('students')->user();

//         $studentTopic = StudentTopic::with(['teacher', 'topic' => function ($topic) {
//             $topic->with('topic');
//         }])->find($id);

//         if (!$studentTopic) {
//             return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể nộp quyển đồ án');
//         }
//         if (!checkInTime($studentTopic->topic->tc_start_thesis_book, $studentTopic->topic->tc_end_thesis_book)) {
//             return redirect()->back()->with('error', 'Hết thời gian nộp quyển đồ án');
//         }
//         try {
//             if($request->hasfile('thesis_book'))
//             {
//                 $file = $request->file('thesis_book');
//                 $thesis_book = date('YmdHms').'-'. $user->code .'-'.$file->getClientOriginalName();
//                 $file->move(public_path().'/uploads/documents/', date('YmdHms'). $user->code .$file->getClientOriginalName());
//             }

//             $data = [
//                 'rf_student_topic_id' => $studentTopic->id,
//                 'rf_title' => $request->st_thesis_book,
//                 'rf_part_file' => $thesis_book,
//                 'rf_status' => 1,
//                 'rf_type' => 2,
//             ];

// //            $studentTopic->st_thesis_book = $request->st_thesis_book;
// //            $studentTopic->st_thesis_book_part = $thesis_book;
//             $studentTopic->st_status_thesis_book = 1;

//             if (ResultFile::create($data)) {
//                 // send mail teacher

//                 $dataMail = [
//                     'subject' => 'Thông báo sinh viên ' .$user->name . ' đã nộp file đồ án',
//                     'name_teacher' => isset($studentTopic->teacher) ? $studentTopic->teacher->name : '',
//                     'name_student' => $user->name,
//                     'email' => isset($studentTopic->teacher) ? $studentTopic->teacher->email : '',
//                     'topic' => $studentTopic->topic->topic->t_title,
//                     'title' => $request->st_thesis_book,
//                     'link_download' => $thesis_book,
//                     'status' => 'Đã nộp',
//                     'outline_status' => 0, //1 là đề cương, 0 là đồ án
//                     'teacher_status' => 0
//                 ];

//                 MailHelper::sendMailOutline($dataMail);

//             }
//             return redirect()->back()->with('success','Nộp thành công đồ án');
//         } catch (\Exception $exception) {
//             return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể nộp đồ án');
//         }
//     }

    public function cancel($id)
    {
        $studentTopic = StudentTopic::with(['teacher', 'topic' => function ($topic) {
            $topic->with('topic');
        }])->find($id);

        if (!$studentTopic) {
            return redirect()->back()->with('error', 'Không tìm thấy đề tài');
        }

        if (!checkInTime($studentTopic->topic->tc_start_time, $studentTopic->topic->tc_end_time)) {
            return redirect()->back()->with('error', 'Không phải thời điểm hủy đề tài');
        }
        try {
            if ($studentTopic->delete()) {
                $user = Auth::guard('students')->user();

                $dataMail = [
                    'subject' => 'Thông báo sinh viên ' .$user->name . ' đã hủy đề tài',
                    'name_teacher' => isset($studentTopic->teacher) ? $studentTopic->teacher->name : '',
                    'name_student' => $user->name,
                    'email' => isset($studentTopic->teacher) ? $studentTopic->teacher->email : '',
                    'topic' => $studentTopic->topic->topic->t_title,
                ];

                MailHelper::sendMailCancel($dataMail);
            }
            return redirect()->route('user.home')->with('success','Hủy thành công đề tài');
        } catch (\Exception $exception)
        {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể hủy đề tài');
        }
    }

    public function changePassword()
    {
        return view('page.user.change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user =  User::find(Auth::guard('students')->user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            \DB::commit();
            Auth::guard('students')->logout();
            return redirect()->route('user.login')->with('success', 'Đổi mật khẩu thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể đổi mật khẩu');
        }
    }

    public function getCalendar($id)
    {
        $calendars = Calendar::with('resultFile')->where('student_topic_id', $id)->get();

        $topic = StudentTopic::with(['topic' => function($query) {
            $query->with('topic');
        }, 'student'])->find($id);

        if (!$topic) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $viewData = [
            'calendars' => $calendars,
            'student_topic_id' => $id,
            'topic' => $topic,
            'status' => Calendar::STATUS,
            'classStatus' => Calendar::STUDENT_CLASS_STATUS,
        ];

        return view('page.topic.calendar', $viewData);
    }

    public function getCalendarDetail($id)
    {
        $calendar = Calendar::find($id);

        if (!$calendar) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('page.topic.calendar_detail', compact('calendar'));
    }

    public function calendarFileResult($id)
    {
        $calendar = Calendar::find($id);

        if (!$calendar) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('page.topic.calendar_file', compact('calendar'));
    }

    public function postFileResult(ResultFileRequest $request, $id)
    {
        $user = Auth::guard('students')->user();

        $calendar = Calendar::with('resultFile')->findOrFail($id);
        // Kiểm tra nếu resultFile chưa được khởi tạo
        if (!isset($calendar->resultFile)) {
            $result_file = new ResultFile();
            $result_file->calendar_id = $calendar->id;
            /** Handle file upload */
            $resultPath = $this->uploadResultFile($request, 'rf_path', 'uploads/calendar', $calendar->id);
        }
        else {
            $result_file = $calendar->resultFile;
            /** Handle file update */
            $resultPath = $this->updateResultFile($request, 'rf_path', 'uploads/calendar', $calendar->id, $result_file->rf_path);
        }
        
        try {
            $result_file->rf_title = $request->rf_title;
            $result_file->rf_path = $resultPath;
            $result_file->rf_type = $request->rf_type;
            $result_file->rf_point = null;

            $calendar->status = 1; //1 => 'Đã nộp',
            $calendar->save();
            $result_file->save();

            return redirect()->route('user.get.calendar', $calendar->student_topic_id)->with('success', 'Nộp file thành công.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể nộp file');
        }
    }

    public function downloadFile($id)
    {
        $result_file = ResultFile::findOrFail($id);

        return response()->download(public_path($result_file->rf_path));
    }
}
