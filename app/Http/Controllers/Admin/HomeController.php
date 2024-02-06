<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Topic;
use App\Models\Department;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        view()->share([
            'home_active' => 'active',

        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numStudent = User::where('type', User::STUDENT)->count();
        $numTeacher = User::where('type', User::TEACHER)->count();
        $numTopic = Topic::count();
        $numDepartment = Department::count();
        //
        $viewData = [
            'numStudent' => $numStudent,
            'numTeacher' => $numTeacher,
            'numTopic' => $numTopic,
            'numDepartment' => $numDepartment,
        ];

        return view('admin.home.index', $viewData);
    }

}
