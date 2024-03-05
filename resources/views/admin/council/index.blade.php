@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('council.index') }}">Hội đồng</a></li>
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
                                    @if ($user->can(['toan-quyen-quan-ly', 'tao-moi-hoi-dong']))
                                    <a href="{{ route('council.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
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
                                        <th>Tên hội đồng</th>
                                        <th>Niên khóa</th>
                                        <th>Trạng thái</th>
                                        @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-hoi-dong', 'xoa-hoi-dong']))
                                        <th>Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$councils->isEmpty())
                                        @php $i = $councils->firstItem(); @endphp
                                        @foreach($councils as $council)
                                            <tr>
                                                <td class=" text-center">{{ $i }}</td>
                                                <td>{{$council->co_title}}</td>
                                                <td><span class="label label-success">{{$council->course ? $council->course->c_name : ''}}</span></td>
                                                <td>
                                                    <span class="btn btn-block {{ $council->co_status == 1 ? 'btn-success' : 'btn-secondary' }} btn-xs">{{ $council->co_status == 1 ? 'Đã duyệt ' : 'Chưa duyệt' }}</span>
                                                </td>
                                                @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-hoi-dong', 'xoa-hoi-dong']))
                                                <td class="text-center">
                                                    @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-hoi-dong']))
                                                    <a class="btn btn-primary btn-sm" href="{{ route('council.update', $council->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @endif
                                                    @if ($user->can(['toan-quyen-quan-ly', 'xoa-hoi-dong']))
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('council.delete', $council->id) }}">
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
                            @if($councils->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $councils->appends($query = '')->links() }}
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
