@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Giáo viên</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @php
        $userPresent = Auth::user();
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
                                    <input type="text" name="name" class="form-control mg-r-15" placeholder="Tên">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control mg-r-15" placeholder="Số điện thoại">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control mg-r-15" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="position_id" class="form-control">
                                        <option value="">Chọn chức vụ</option>
                                        @foreach($positions as $key => $position)
                                            <option value="{{$position->id}}">{{$position->p_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="department_id" class="form-control">
                                        <option value="">Chọn phòng ban</option>
                                        @foreach($departments as $key => $department)
                                            <option value="{{$department->id}}">{{$department->dp_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="">Chọn trạng thái</option>
                                        @foreach($status as $key => $item)
                                            <option  value="{{$key}}">{{$item}}</option>
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
                                    @if ($userPresent->can(['toan-quyen-quan-ly', 'tao-moi-giao-vien']))
                                    <a href="{{ route('user.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
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
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Vai trò</th>
                                        <th>Chức vụ</th>
                                        <th>Khoa</th>
                                        <th>Trạng thái</th>
                                        @if ($userPresent->can(['toan-quyen-quan-ly', 'chinh-sua-giao-vien', 'xoa-giao-vien']))
                                        <th class=" text-center">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$users->isEmpty())
                                        @php $i = $users->firstItem(); @endphp
                                        @foreach($users as $user)
                                            <tr>
                                                <td class=" text-center">{{ $i }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    @if($user->userRole != null)
                                                        @foreach($user->userRole as $role)
                                                            <span class="label label-success">{{$role->display_name}}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ isset($user->position) ? $user->position->p_name : '' }}
                                                </td>
                                                <td>
                                                    {{ isset($user->department) ? $user->department->dp_name : '' }}
                                                </td>
                                                <td>
                                                    <span class="btn btn-block {{ $user->status == 1 ? 'btn-success' : 'btn-secondary' }} btn-xs">{{ $user->status == 1 ? 'Hoạt động' : 'Đã khóa' }}</span>
                                                </td>
                                                @if ($userPresent->can(['toan-quyen-quan-ly', 'chinh-sua-giao-vien', 'xoa-giao-vien']))
                                                <td class="text-center">
                                                    @if ($userPresent->can(['toan-quyen-quan-ly', 'chinh-sua-giao-vien']))
                                                    <a class="btn btn-primary btn-sm" href="{{ route('user.update', $user->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @endif
                                                    @if ($userPresent->can(['toan-quyen-quan-ly', 'xoa-giao-vien']))
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('user.delete', $user->id) }}">
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
                            @if($users->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $users->appends($query = '')->links() }}
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
