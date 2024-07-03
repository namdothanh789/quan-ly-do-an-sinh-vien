@extends('admin.layouts.main')
@section('title', 'Thống kê điểm báo cáo')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.points.index', ['studentTopicId' => $studentTopicId]) }}"> <i class="nav-icon fas fa fa-star"></i> Điểm quá trình</a></li>
                        <li class="breadcrumb-item active">Thống kê điểm báo cáo</li>
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
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Tên file báo cáo</th>
                                        <th>Điểm</th>
                                        <th>Loại báo cáo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$calendars->isEmpty())
                                        @php $i = $calendars->firstItem(); @endphp
                                        @foreach($calendars as $calendar)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                                <td style="vertical-align: middle">{{$calendar->resultFile->rf_title}}</td>
                                                <td style="vertical-align: middle">{{$calendar->resultFile->rf_point}}</td>
                                                <td style="vertical-align: middle">
                                                  @if ($calendar->resultFile->rf_type == 0)
                                                    File báo cáo
                                                  @else
                                                    File đồ án
                                                  @endif
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($calendars->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $calendars->appends($query = '')->links() }}
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
