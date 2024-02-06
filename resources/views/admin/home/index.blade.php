@extends('admin.layouts.main')
@section('title', 'Quản lý công việc')
@section('style-css')
    <!-- fullCalendar -->
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý khóa luận</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản lý khóa luận</a></li>
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
                <div class="card-header">
                    <h3 class="card-title">Thống kê dữ liệu</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $numTeacher }}</h3>

                                    <p>Tổng số giáo viên</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-fw fa-user"></i>
                                </div>
                                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-giao-vien']))
                                <a href="{{ route('user.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                @else
                                    <a href="#" class="small-box-footer"></a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $numStudent }}</h3>

                                    <p>Tổng số sinh viên</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-graduation-cap"></i>
                                </div>
                                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-sinh-vien']))
                                    <a href="{{ route('student.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                @else
                                    <a href="#" class="small-box-footer"> </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box btn-primary">
                                <div class="inner">
                                    <h3>{{ $numTopic }}</h3>

                                    <p>Tổng số đề tài</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-file-word"></i>
                                </div>
                                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-de-tai']))
                                <a href="{{ route('topic.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                @else
                                    <a href="#" class="small-box-footer"> </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box btn-default">
                                <div class="inner">
                                    <h3>{{ $numDepartment }}</h3>

                                    <p>Tổng số khoa / bộ môn</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-fw fa-sitemap"></i>
                                </div>
                                @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-khoa-bo-mon',]))
                                    <a href="{{ route('department.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                                @else
                                    <a href="#" class="small-box-footer"> </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{--<section class="content">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="card card-default">--}}
                {{--<div class="card-header">--}}
                    {{--<h3 class="card-title">Thống kê dữ liệu theo niên khóa</h3>--}}
                    {{--<div class="card-tools">--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- /.card-header -->--}}
                {{--<div class="card-body">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-lg-3 col-6">--}}
                            {{--<!-- small box -->--}}
                            {{--<div class="small-box bg-success">--}}
                                {{--<div class="inner">--}}
                                    {{--<h3>53<sup style="font-size: 20px">%</sup></h3>--}}

                                    {{--<p>Tỉ lệ đăng ký</p>--}}
                                {{--</div>--}}
                                {{--<div class="icon">--}}
                                    {{--<i class="ion ion-stats-bars"></i>--}}
                                {{--</div>--}}
                                {{--@if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-dang-ky-de-tai']))--}}
                                    {{--<a href="{{ route('student.topics.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>--}}
                                {{--@else--}}
                                    {{--<a href="#" class="small-box-footer"></a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-3 col-6">--}}
                            {{--<!-- small box -->--}}
                            {{--<div class="small-box bg-info">--}}
                                {{--<div class="inner">--}}
                                    {{--<h3>150</h3>--}}

                                    {{--<p>Tổng số giáo viên</p>--}}
                                {{--</div>--}}
                                {{--<div class="icon">--}}
                                    {{--<i class="nav-icon fa fa-fw fa-user"></i>--}}
                                {{--</div>--}}
                                {{--@if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-giao-vien']))--}}
                                    {{--<a href="{{ route('user.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>--}}
                                {{--@else--}}
                                    {{--<a href="#" class="small-box-footer"></a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-3 col-6">--}}
                            {{--<!-- small box -->--}}
                            {{--<div class="small-box bg-info">--}}
                                {{--<div class="inner">--}}
                                    {{--<h3>150</h3>--}}

                                    {{--<p>Tổng số sinh viên</p>--}}
                                {{--</div>--}}
                                {{--<div class="icon">--}}
                                    {{--<i class="nav-icon fa fa-graduation-cap"></i>--}}
                                {{--</div>--}}
                                {{--@if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-sinh-vien']))--}}
                                    {{--<a href="{{ route('student.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>--}}
                                {{--@else--}}
                                    {{--<a href="#" class="small-box-footer"> </a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-3 col-6">--}}
                            {{--<!-- small box -->--}}
                            {{--<div class="small-box btn-primary">--}}
                                {{--<div class="inner">--}}
                                    {{--<h3>150</h3>--}}

                                    {{--<p>Tổng số đề tài</p>--}}
                                {{--</div>--}}
                                {{--<div class="icon">--}}
                                    {{--<i class="nav-icon fas fa-file-word"></i>--}}
                                {{--</div>--}}
                                {{--@if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-de-tai']))--}}
                                    {{--<a href="{{ route('topic.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>--}}
                                {{--@else--}}
                                    {{--<a href="#" class="small-box-footer"> </a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-lg-3 col-6">--}}
                            {{--<!-- small box -->--}}
                            {{--<div class="small-box btn-warning">--}}
                                {{--<div class="inner">--}}
                                    {{--<h3>150</h3>--}}

                                    {{--<p>Tổng số hôi đồng</p>--}}
                                {{--</div>--}}
                                {{--<div class="icon">--}}
                                    {{--<i class="nav-icon fas fa-file-word"></i>--}}
                                {{--</div>--}}
                                {{--@if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-hoi-dong']))--}}
                                    {{--<a href="{{ route('council.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>--}}
                                {{--@else--}}
                                    {{--<a href="#" class="small-box-footer"> </a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<!-- /.col -->--}}
                {{--<div class="col-md-12">--}}

                    {{--<!-- /.card -->--}}
                {{--</div>--}}
                {{--<!-- /.col -->--}}
            {{--</div>--}}
            {{--<!-- /.row -->--}}
        {{--</div><!-- /.container-fluid -->--}}
    {{--</section>--}}
@stop
@section('script')

@stop