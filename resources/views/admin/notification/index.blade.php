@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('notifications.index') }}">Thông báo đợt đăng ký khóa luận</a></li>
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
                                    <input type="text" name="n_title" class="form-control mg-r-15" placeholder="Tiêu đề">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <select name="n_course_id" class="form-control">
                                    <option value="">Chọn niên khóa</option>
                                    @foreach($courses as $key => $course)
                                        <option value="{{$course->id}}">{{$course->c_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="n_status" class="form-control">
                                        <option value="">Chọn trạng thái</option>
                                        @foreach($status as $key => $item)
                                            <option  value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="n_type" class="form-control">
                                        <option value="">Loại thông báo</option>
                                        @foreach($types as $key => $type)
                                            <option value="{{$key}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="n_send_to" class="form-control">
                                        <option value="">Gửi cho</option>
                                        @foreach($sendTo as $key => $item)
                                            <option  {{old('n_send_to', isset($notification) ? $notification->n_send_to : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
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
                                    @if ($user->can(['toan-quyen-quan-ly', 'tao-moi-thong-bao']))
                                    <a href="{{ route('notifications.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
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
                                        <th>Tiêu đề</th>
                                        <th>Niên khóa</th>
                                        <th>Loại thông báo</th>
                                        <th>Gửi cho</th>
                                        <th>Trạng thái</th>
                                        @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-thong-bao', 'xoa-thong-bao']))
                                        <th class=" text-center" width="12%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$notifications->isEmpty())
                                        @php $i = $notifications->firstItem(); @endphp
                                        @foreach($notifications as $notification)
                                            <tr>
                                                <td class=" text-center">{{ $i }}</td>
                                                <td>{{ $notification->n_title }}</td>
                                                <td>{{ isset($notification->course) ? $notification->course->c_name : '' }}</td>
                                                <td>{{ isset($types[$notification->n_type]) ? $types[$notification->n_type] : '' }}</td>
                                                <td>{{ isset($sendTo[$notification->n_send_to]) ? $sendTo[$notification->n_send_to] : '' }}</td>
                                                <td><span class="btn btn-block {{ $notification->n_status == 1 ? 'btn-success' : 'btn-secondary' }} btn-xs">{{ $notification->n_status == 1 ? 'Đã duyệt ' : 'Chưa duyệt' }}</span></td>
                                                @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-thong-bao', 'xoa-thong-bao']))
                                                <td class="text-center">
                                                    @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-thong-bao']))
                                                    <a class="btn btn-primary btn-sm" href="{{ route('notifications.update', $notification->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @endif
                                                    @if ($user->can(['toan-quyen-quan-ly', 'xoa-thong-bao']))
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('notifications.delete', $notification->id) }}">
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
                            @if($notifications->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $notifications->appends($query = '')->links() }}
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
