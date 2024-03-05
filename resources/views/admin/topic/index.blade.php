@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('topic.index') }}">Đề tài</a></li>
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
                                    <input type="text" name="t_title" class="form-control mg-r-15" placeholder="Tên đề tài">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <select name="t_department_id" class="form-control">
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
                                    <select name="t_status" class="form-control">
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
                                    @if ($user->can(['toan-quyen-quan-ly', 'tao-moi-de-tai']))
                                    <a href="{{ route('topic.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
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
                                        <th>Tên đề tài</th>
                                        <th>Thuộc khoa / bộ môn</th>
                                        @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-de-tai', 'xoa-de-tai']))
                                        <th>Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$topics->isEmpty())
                                        @php $i = $topics->firstItem(); @endphp
                                        @foreach($topics as $topic)
                                            <tr>
                                                <td class=" text-center">{{ $i }}</td>
                                                <td>{{$topic->t_title}}</td>
                                                <td><span class="label label-success">{{$topic->department->dp_name}}</span></td>
                                                <td>
                                                    <span class="btn btn-block {{ $topic->t_status == 1 ? 'btn-success' : 'btn-secondary' }} btn-xs">{{ $topic->t_status == 1 ? 'Đã duyệt ' : 'Chưa duyệt' }}</span>
                                                </td>
                                                @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-de-tai', 'xoa-de-tai']))
                                                <td class="text-center">
                                                    @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-de-tai']))
                                                    <a class="btn btn-primary btn-sm" href="{{ route('topic.update', $topic->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @endif
                                                    @if ($user->can(['toan-quyen-quan-ly', 'xoa-de-tai']))
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('topic.delete', $topic->id) }}">
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
