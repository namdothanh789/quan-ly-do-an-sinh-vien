<?php
namespace App\Http\ViewComposer;
use DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentTopic;
use App\Models\TopicCourse;

class StudentTopicComposer
{

    public function compose(View $view)
    {
        $user = Auth::guard('students')->user();
        $topics = TopicCourse::where(['tc_course_id' => $user->course_id, 'tc_department_id' => $user->department_id, 'tc_status' => 1])->get();
        $listIdTopic = $topics->pluck('id')->toArray();

        $sudentTopics = StudentTopic::whereIn('st_topic_id', $listIdTopic)->count();

        $param = [
            'st_student_id' => $user->id,
            'st_course_id' => $user->course_id,
        ];
        $studentTopic = StudentTopic::with('topic')->where($param)->first();
        $data = [
            'sudentTopics' => $sudentTopics,
            'studentTopic' => $studentTopic,
            'numberTopic'  => $topics->count()
        ];

        $view->with($data);
    }
}