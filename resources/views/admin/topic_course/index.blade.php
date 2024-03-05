@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('topic.course.index') }}">Đề tài theo năm</a></li>
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
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <input type="text" name="keyword" class="form-control mg-r-15" placeholder="Tên đề tài">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="tc_course_id" class="form-control">
                                        <option value="">Chọn niên khóa</option>
                                        @foreach($courses as $key => $course)
                                            <option value="{{$course->id}}">{{$course->c_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="tc_department_id" class="form-control">
                                        <option value="">Chọn khoa / bộ môn</option>
                                        @foreach($departments as $key => $department)
                                            @if ($department->parents->isNotEmpty())
                                                <optgroup label="{{ $department->dp_name }}">
                                                    @foreach($department->parents as $parent)
                                                        <option value="{{$parent->id}}">{{$parent->dp_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option value="{{$department->id}}">
                                                    {{$department->dp_name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="tc_teacher_id" class="form-control">
                                        <option value="">Giáo viên HD</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <select name="tc_status" class="form-control">
                                        <option value="">Chọn trạng thái</option>
                                        @foreach($status as $key => $item)
                                            <option  value="{{$key}}">{{$item}}</option>
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
                                    @if ($user->can(['toan-quyen-quan-ly', 'tao-moi-de-tai-theo-nam']))
                                    <a href="{{ route('topic.course.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Thông tin</th>
                                        <th title="Số lượng sinh viên đăng ký tối đa">Số lượng</th>
                                        <th>Niên khóa</th>
                                        <th>Giáo viên HD</th>
                                        <th>Khoa / Bộ môn</th>
                                        <th>Hội đồng</th>
                                        <th>Trạng thái</th>
                                        @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-de-tai-theo-nam', 'xoa-de-tai-theo-nam']))
                                        <th>Hành động</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                @if (!$topics->isEmpty())
                                    @php $i = $topics->firstItem(); @endphp
                                    @foreach($topics as $topic)
                                        <tr>
                                            <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                            <td style="vertical-align: middle" class="topic-title">
                                                <b>{{$topic->topic->t_title}}</b>
                                                {{--<p>Ngày đăng ký : {{$topic->tc_start_time}}</p>--}}
                                                {{--<p>Ngày KT đăng ký : {{$topic->tc_end_time}}</p>--}}
                                                {{--<p>Ngày nộp đề cương : {{$topic->tc_start_outline}}</p>--}}
                                                {{--<p>Ngày KT nộp đề cương : {{$topic->tc_end_outline}}</p>--}}
                                                {{--<p>Ngày nộp báo cáo : {{$topic->tc_start_thesis_book}}</p>--}}
                                                {{--<p>Ngày KT nộp báo cáo : {{$topic->tc_end_thesis_book}}</p>--}}
                                            </td>
                                            <td style="vertical-align: middle">{{$topic->tc_registration_number}}</td>
                                            <td style="vertical-align: middle">{{$topic->course->c_name}}</td>
                                            <td style="vertical-align: middle">{{$topic->teacher->name}}</td>
                                            <td style="vertical-align: middle">{{$topic->department->dp_name}}</td>
                                            <td style="vertical-align: middle">{{isset($topic->council) ? $topic->council->co_title : ''}}</td>
                                            <td style="vertical-align: middle"> <span class="btn btn-block {{ $topic->tc_status == 1 ? 'btn-success' : 'btn-secondary' }} btn-xs">{{ $topic->tc_status == 1 ? 'Đã duyệt ' : 'Chưa duyệt' }}</span></td>
                                            @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-de-tai-theo-nam', 'xoa-de-tai-theo-nam']))
                                            <td class="text-center" style="vertical-align: middle">
                                                @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-de-tai-theo-nam']))
                                                <a class="btn btn-primary btn-sm" href="{{ route('topic.course.update', $topic->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                @endif
                                                @if ($user->can(['toan-quyen-quan-ly', 'xoa-de-tai-theo-nam']))
                                                <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('topic.course.delete', $topic->id) }}">
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
                            @if($topics->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $topics->appends($query = '')->links() }}
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop
