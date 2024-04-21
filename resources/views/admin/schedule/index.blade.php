@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('schedule.student.index') }}">Lịch hẹn</a></li>
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
                                    @if ($user->can(['toan-quyen-quan-ly', 'tao-moi-lich-hen']))
                                    <a href="{{ route('schedule.student.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
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
                                        <th>Người tạo</th>
                                        <th>Đối tượng hẹn</th>
                                        <th>Bắt đầu</th>
                                        <th>Kết thúc</th>
                                        <th>Loại </th>
                                        {{--<th>Trạng thái</th>--}}
                                        <th>Nôi dung</th>
                                        <th>Ngày tạo</th>
                                        @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-lich-hen', 'xoa-lich-hen']))
                                        <th class=" text-center" width="12%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$notifications->isEmpty())
                                        @php $i = $notifications->firstItem(); @endphp
                                        @foreach($notifications as $notification)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                                <td style="vertical-align: middle">{{ $notification->n_type == 6 ? 'GV :' : 'SV :' }}{{ isset($notification->user) ? $notification->user->name : '' }}</td>
                                                <td style="vertical-align: middle">
                                                    @if (isset($notification->notificationUsers))
                                                        @foreach($notification->notificationUsers as $item)
                                                            <p style="margin: 0px 0px 5px 0px">{{ $item->user->name }}</p>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle">{{ !empty($notification->n_from_date) ? convertDatetimeLocal($notification->n_from_date) : '' }}</td>
                                                <td style="vertical-align: middle">{{ !empty($notification->n_end_date) ? convertDatetimeLocal($notification->n_end_date) : '' }}</td>
                                                <td style="vertical-align: middle">{{ isset($schedule_types[$notification->n_schedule_type]) ? $schedule_types[$notification->n_schedule_type] : '' }}</td>
                                                {{--<td style="vertical-align: middle"><span class="btn btn-block {{ $notification->n_status == 1 ? 'btn-success' : 'btn-secondary' }} btn-xs">{{ $notification->n_status == 1 ? 'Đã họp ' : 'Chưa họp' }}</span></td>--}}
                                                <td style="vertical-align: middle"><a href="{{ route('schedule.student.show', $notification->id) }}">Chi tiết nội dung</a></td>
                                                <td style="vertical-align: middle">{{ $notification->created_at }}</td>
                                                @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-lich-hen', 'xoa-lich-hen']))
                                                <td class="text-center" style="vertical-align: middle">
                                                    @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-lich-hen']))
                                                    <a class="btn btn-primary btn-sm" href="{{ route('schedule.student.update', $notification->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @endif
                                                    @if ($user->can(['toan-quyen-quan-ly', 'xoa-lich-hen']))
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('schedule.student.delete', $notification->id) }}">
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
