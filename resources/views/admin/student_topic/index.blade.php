@extends('admin.layouts.main')
@section('title', '')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('student.topics.index') }}">Sinh viên đăng ký</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@php
    $user = Auth::user();
@endphp
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h3 class="card-title">From tìm kiếm</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <input type="text" name="code" class="form-control mg-r-15" placeholder="Mã sinh viên">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control mg-r-15" placeholder="Họ và tên">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <select class="custom-select" name="teacher_id">
                                    <option value="">Chọn giáo viên</option>
                                    @foreach($teachers as $teacher)
                                    <option {{old('tc_teacher_id', isset($topicCourse->tc_teacher_id) ? $topicCourse->tc_teacher_id : '') == $teacher->id ? 'selected="selected"' : ''}} value="{{$teacher->id}}">
                                        {{$teacher->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="form-group">
                                <select name="tc_course_id" class="form-control">
                                    <option value="">Chọn niên khóa</option>
                                    @foreach($courses as $key => $course)
                                    <option value="{{$course->id}}">{{$course->c_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--<div class="col-sm-12 col-md-3">--}}
                        {{--<div class="form-group">--}}
                        {{--<select name="department_id" class="form-control">--}}
                        {{--<option value="">Chọn khoa</option>--}}
                        {{--@foreach($departments as $key => $department)--}}
                        {{--@if ($department->parents->isNotEmpty())--}}
                        {{--<optgroup label="{{ $department->dp_name }}">--}}
                        {{--@foreach($department->parents as $parent)--}}
                        {{--<option value="{{$parent->id}}">{{$parent->dp_name}}</option>--}}
                        {{--@endforeach--}}
                        {{--</optgroup>--}}
                        {{--@else--}}
                        {{--<option value="{{$department->id}}">--}}
                        {{--{{$department->dp_name}}--}}
                        {{--</option>--}}
                        {{--@endif--}}
                        {{--@endforeach--}}
                        {{--</select>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-sm-12 col-md-2">
                            <div class="input-group-append">
                                <button type="submit" name="search" value="true" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="btn-group">
                                {{--<a href="{{ route('student.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>--}}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="4%" class=" text-center">STT</th>
                                    <th>Tên đề tài</th>
                                    <th>Sinh viên</th>
                                    <th>Mã sinh viên</th>
                                    <th>Niên khóa</th>
                                    <th>Bộ môn</th>
                                    <th>Giáo viên hướng dẫn</th>
                                    <th>Đề cương</th>
                                    <th>Điểm ĐC</th>
                                    <th>Quyển khóa luận</th>
                                    <th>Điểm KL</th>
                                    <th>Điểm BV</th>
                                    <th>Điểm TB</th>
                                    <th>Trạng thái</th>
                                    @if ($user->can(['toan-quyen-quan-ly', 'nhan-set-va-cham-diem-de-tai', 'xoa-de-tai-sinh-vien-dang-ky']))
                                    <th class=" text-center">Hành động</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$studentTopics->isEmpty())
                                @php $i = $studentTopics->firstItem(); @endphp
                                @foreach($studentTopics as $student)
                                <tr>
                                    <td style="vertical-align: middle" class=" text-center">{{ $i }}</td>
                                    <td style="vertical-align: middle" class="topic-title">{{ isset($student->topic) ? $student->topic->topic->t_title : '' }}</td>
                                    <td style="vertical-align: middle">{{ isset($student->student) ? $student->student->name : '' }}</td>
                                    <td style="vertical-align: middle">{{ isset($student->student) ? $student->student->code : '' }}</td>
                                    <td style="vertical-align: middle">{{ isset($student->course) ? $student->course->c_name : '' }}</td>
                                    <td style="vertical-align: middle">{{ isset($student->topic) ?  $student->topic->department->dp_name : '' }}</td>
                                    <td style="vertical-align: middle">
                                        {{ isset($student->teacher) ? $student->teacher->name : '' }}
                                    </td>
                                    <td style="vertical-align: middle">
                                        <p style="margin: 2px">{{ isset($status_outline[$student->st_status_outline]) ? $status_outline[$student->st_status_outline] : 'Chưa nộp' }}</p>
                                        @if (!empty($student->st_outline_part) && !empty($student->st_status_outline))
                                        <a href="{!! asset('uploads/documents/' . $student->st_outline_part) !!}" target="_blank" download>download</a>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle">{{ $student->st_point_outline }}</td>
                                    <td style="vertical-align: middle">
                                        <p>{{ isset($status_outline[$student->st_status_thesis_book]) ? $status_outline[$student->st_status_thesis_book] : 'Chưa nộp' }}</p>
                                        @if (!empty($student->st_thesis_book_part) && !empty($student->st_status_thesis_book))
                                        <a href="{!! asset('uploads/documents/' . $student->st_thesis_book_part) !!}" target="_blank" download>Dowload</a>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle">{{ $student->st_point_thesis_book }}</td>
                                    <td style="vertical-align: middle">{{ $student->st_point }}</td>
                                    <td style="vertical-align: middle">{{ round(($student->st_point + $student->st_point_outline + $student->st_point_thesis_book)/3, 2) }}</td>
                                    <td style="vertical-align: middle">{{ isset($status[$student->st_status]) ? $status[$student->st_status] : '' }}</td>
                                    @if ($user->can(['toan-quyen-quan-ly', 'nhan-set-va-cham-diem-de-tai', 'xoa-de-tai-sinh-vien-dang-ky']))
                                    <td style="vertical-align: middle">
                                        @if ($user->can(['toan-quyen-quan-ly', 'nhan-set-va-cham-diem-de-tai']))
                                        <a class="btn btn-primary btn-sm" href="{{ route('student.topics.update', $student->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        @endif
                                        @if ($user->can(['toan-quyen-quan-ly', 'xoa-de-tai-sinh-vien-dang-ky']))
                                        <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('student.topics.delete', $student->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @php $i++ @endphp
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@stop