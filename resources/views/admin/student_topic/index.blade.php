@extends('admin.layouts.main')
@section('title', 'Danh sách đề tài')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{ route('student.topics.index') }}">Danh sách đề tài</a></li> --}}
                    <li class="breadcrumb-item active">Danh sách đề tài</li>
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
                <h3 class="card-title">Form tìm kiếm</h3>
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
                                    <th>Đề cương</th>
                                    <th>Điểm TB đề cương</th>
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
                                        <p style="margin: 2px">{{ isset($status_outline[$student->st_status_outline]) ? $status_outline[$student->st_status_outline] : 'Chưa nộp' }}</p>
                                        @if ($student->result_outline_files()->count() > 0)
                                        <a href="{{ route('student.topics.view.files', ['id' => $student->id, 'type' => 1]) }}" target="_blank" >Danh sách file {{ $student->result_outline_files()->count() }}</a>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle">
                                        @php
                                            $number_file = 0;
                                            $total_point = 0;
                                        @endphp
                                        @foreach($student->result_outline_files as $outline_file)
                                            @if ($outline_file->rf_status == 2)
                                                @php $number_file = $number_file + 1; @endphp
                                                @php $total_point = $total_point + $outline_file->rf_point; @endphp
                                            @endif
                                        @endforeach
                                        {{ $total_point > 0 ? round($total_point / $number_file, 2) : 0 }}
                                    </td>

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
                                        @if ($user->can(['toan-quyen-quan-ly', 'danh-sach-phan-cong-cong-viec']))
                                        <a class="btn btn-info btn-sm" href="{{ route('calendar.index', $student->id) }}" title="Phân công công việc">
                                            <i class="fa fa-fw fa-calendar"></i>
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