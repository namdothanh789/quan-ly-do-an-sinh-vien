@extends('page.layouts.main')
@section('title', 'Trang chủ')
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
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col" style="flex-basis: unset !important;">
                                <h3 class="mb-0" style="text-transform: uppercase;">PHÂN CÔNG CÔNG VIỆC</h3>
                            </div>
                            <div class="col text-right">
                                {{--<a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col=md-12">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="text-align: center">STT</th>
                                    <th scope="col">Tiêu đề công việc</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">File báo cáo</th>
                                    <th scope="col">Nội dung</th>
                                    <th scope="col">Báo cáo</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Loại file cần nộp</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        @foreach($calendars as $key => $calendar)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle">{{ $key + 1 }}</td>
                                                <td style="vertical-align: middle">{{$calendar->title}}</td>
                                                <td style="vertical-align: middle">
                                                    <p>{{ $calendar->start_date .' đến '.$calendar->end_date }}</p>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    @if (!empty($calendar->resultFile) && !empty($calendar->resultFile->rf_path))
                                                        <a href="{{ route('file.result.download', ['id' => $calendar->resultFile->id]) }}" target="_blank" download>Dowload file</a>
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <a href="{{ route('user.get.calendar.detail', $calendar->id) }}">Chi tiết công việc</a>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <a href="{{ route('file.result', ['id' => $calendar->id, 'type' => $calendar->type]) }}" class="work-content" >Gửi file</a>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <span class="{{ $classStatus[$calendar->status] }}">{{ $status[$calendar->status] }}</span>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    @if ($calendar->type == 0)
                                                        File báo cáo
                                                    @elseif ($calendar->type == 1)
                                                        File đồ án
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop