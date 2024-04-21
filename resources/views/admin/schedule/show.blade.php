@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
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
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <h3 class="text-center">CHI TIẾT LỊCH HẸN</h3>
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
                                <div class="card-tools" bis_skin_checked="1">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
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
    </section>
@stop
