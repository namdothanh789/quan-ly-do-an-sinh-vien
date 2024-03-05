@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('position.index') }}">Chức vụ</a></li>
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
                                    @if ($user->can(['toan-quyen-quan-ly', 'tao-moi-chuc-vu']))
                                    <a href="{{ route('position.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
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
                                        <th>Tên chức vụ</th>
                                        <th>Mô tả</th>
                                        <th width="10%">Ngày tạo</th>
                                        @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-chuc-vu', 'xoa-chuc-vu']))
                                        <th class=" text-center" width="12%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$positions->isEmpty())
                                        @php $i = $positions->firstItem(); @endphp
                                        @foreach($positions as $position)
                                            <tr>
                                                <td class=" text-center">{{ $i }}</td>
                                                <td>{{ $position->p_name }}</td>
                                                <td>{{ $position->p_content }}</td>
                                                <td>{{ $position->created_at }}</td>
                                                @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-chuc-vu', 'xoa-chuc-vu']))
                                                <td class="text-center">
                                                    @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-chuc-vu']))
                                                        <a class="btn btn-primary btn-sm" href="{{ route('position.update', $position->id) }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    @endif
                                                        @if ($user->can(['toan-quyen-quan-ly', 'xoa-chuc-vu']))
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('position.delete', $position->id) }}">
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
                            @if($positions->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $positions->appends($query = '')->links() }}
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
