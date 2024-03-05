@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Niên khóa</a></li>
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group">
                                    @if ($user->can(['toan-quyen-quan-ly', 'tao-moi-nien-khoa']))
                                    <a href="{{ route('course.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
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
                                        <th>Niên khóa</th>
                                        <th>Thời gian bắt đầu đăng ký</th>
                                        <th>Thời gian kết thúc đăng ký</th>
                                        <th width="10%">Ngày tạo</th>
                                        @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-nien-khoa', 'xoa-nien-khoa']))
                                        <th class=" text-center" width="12%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$courses->isEmpty())
                                        @php $i = $courses->firstItem(); @endphp
                                        @foreach($courses as $course)
                                            <tr>
                                                <td class=" text-center">{{ $i }}</td>
                                                <td>{{ $course->c_name }}</td>
                                                <td>{{ $course->c_start_time }}</td>
                                                <td>{{ $course->c_end_time }}</td>
                                                <td>{{ $course->created_at }}</td>
                                                @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-nien-khoa', 'xoa-nien-khoa']))
                                                <td class="text-center">
                                                    @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-nien-khoa']))
                                                    <a class="btn btn-primary btn-sm" href="{{ route('course.update', $course->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @endif
                                                    @if ($user->can(['toan-quyen-quan-ly', 'xoa-nien-khoa']))
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('course.delete', $course->id) }}">
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
                            @if($courses->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $courses->appends($query = '')->links() }}
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
