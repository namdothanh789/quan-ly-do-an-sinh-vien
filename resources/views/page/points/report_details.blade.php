@extends('page.layouts.main')
@section('title', 'Thống kê điểm báo cáo')
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
                            <h3 class="mb-0" style="text-transform: uppercase;">THỐNG KÊ ĐIỂM BÁO CÁO</h3>
                        </div>
                    </div>
                </div>
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
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop