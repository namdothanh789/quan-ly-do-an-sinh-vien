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
            @php
                $user = Auth::user();
            @endphp
            <div class="col-xl-12" style="margin: auto">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8" style="flex-basis: unset !important;">
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <h3 class="text-center" style="margin-top: 50px">CHI TIẾT LỊCH HẸN</h3>
                                    <div class="col-md-12" style="margin: auto">
                                        <p>
                                            {{ $notification->n_type == 6 ? 'Giáo viên :' : 'Sinh viên :' }} {{ $notification->user->name }}
                                        </p>
                                        <p>
                                            Tiêu đề : {{ $notification->n_title }}
                                        </p>
                                        <p>
                                            Bắt đầu từ : {{ convertDatetimeLocal($notification->n_from_date) }}
                                        </p>
                                        <p>
                                            Kết thúc : {{ convertDatetimeLocal($notification->n_end_date) }}
                                        </p>
                                        <p>Nội dung cuộc hẹn : </p>
                                        {!! $notification->n_content !!}
                                    </div>
                                </div>

                                <!-- /.card-body -->
                            </div>

                            <!-- /.card -->
                            <div class="card">
                                <div class="card-body table-responsive p-0">
                                    <div class="card-header card-header-border-bottom" bis_skin_checked="1">
                                        <h3 class="card-title">Danh sách thành viên</h3>
                                    </div>
                                    <table class="table table-hover text-nowrap table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="4%" class=" text-center">STT</th>
                                            <th>Họ tên</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($notification->notificationUsers as $key => $user)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle">{{ $key + 1 }}</td>
                                                <td style="vertical-align: middle">{{ $user->user->name }}</td>
                                                <td style="vertical-align: middle">{{ $status[$user->nu_status] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">

                </div>
            </div>
        </div>

        <!-- Main content -->
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop