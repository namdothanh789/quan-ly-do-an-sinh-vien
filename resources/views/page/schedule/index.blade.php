@extends('page.layouts.main')
@section('title')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
            @include('page.common.breadcrumb')
            <!-- Card stats -->
                @include('page.common.topic_user')
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12" style="margin: auto">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8" style="flex-basis: unset !important;">
                            <h3 class="mb-0" style="text-transform: uppercase;">LỊCH HẸN</h3>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('schedule.teacher.create') }}" class="btn btn-sm btn-primary">Tạo mới</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsiver">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tiêu đề </th>
                                    <th scope="col">Giáo viên</th>
                                    <th>Loại </th>
                                    <th scope="col">Thời gian bắt đầu</th>
                                    <th scope="col">Thời gian kết thúc</th>
                                    <th scope="col">Nội dung </th>
                                    <th scope="col">Ngày tạo</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (!$notifications->isEmpty())
                                @php $i = $notifications->firstItem(); @endphp
                                @foreach($notifications as $notification)
                                    <tr>
                                        <td class=" text-center">{{ $i }}</td>
                                        <td>{{ $notification->n_title }}</td>
                                        <td>
                                            @if(isset($notification->notificationUsers))
                                                @foreach($notification->notificationUsers as $user)
                                                    {{ $user->user->name }}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle">{{ isset($schedule_types[$notification->n_schedule_type]) ? $schedule_types[$notification->n_schedule_type] : '' }}</td>
                                        <td>
                                            {{ $notification->n_from_date }}
                                        </td>
                                        <td>
                                            {{ $notification->n_end_date }}
                                        </td>
                                        <td><a href="">Nội dung</a></td>
                                        <td>{{ $notification->created_at }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="{{ route('schedule.teacher.update', $notification->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('schedule.teacher.delete', $notification->id) }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="card-footer py-4">
                            <nav aria-label="...">
                                @if($notifications->hasPages())
                                    {{ $notifications->appends($query= '')->links('page.paginator.index') }}
                                @endif
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop