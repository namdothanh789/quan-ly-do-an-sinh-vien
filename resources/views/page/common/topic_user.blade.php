<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body" style="min-height: 142px">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Danh sách đề tài</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $numberTopic }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{--<p class="mt-3 mb-0 text-sm">--}}
                        {{--<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
                        {{--<span class="text-nowrap">Tỉ lệ đăng ký</span>--}}
                    {{--</p>--}}
                    <p class="mt-3 mb-0 text-sm col text-right">
                        <a href="{{ route('topic.register.result') }}" class="btn btn-sm btn-success">Xem chi tiết</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @if (isset($studentTopic))
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body" style="min-height: 142px">
                    <div class="row">
                        <div class="col" style="padding: 0px">
                            <h5 class="card-title text-uppercase text-muted mb-0">Nộp file báo cáo</h5>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-folder-17"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <p class="mt-3 mb-0 text-sm">
                            @if (isset($studentTopic->topic) && in_array($studentTopic->st_status_outline, [1, 2]))
                                <span class="badge badge-success">Đã nộp</span>
                            @endif

                            @if (isset($studentTopic->topic) && checkTime($studentTopic->topic->tc_end_outline) < 0 )
                                <span class="badge badge-danger">Hết thời gian</span>
                            @endif
                        </p> --}}

                        <p class="mt-3 mb-0 text-sm col text-right">
                            {{-- @if (isset($studentTopic->topic) && checkInTime($studentTopic->topic->tc_start_outline, $studentTopic->topic->tc_end_outline))
                                <a href="{{ route('user.outline') }}" class="btn btn-sm btn-success">Nộp file báo cáo</a> --}}
                            @if (isset($studentTopic->topic))
                            <a href="{{ route('user.get.calendar', ['id' => $studentTopic->id]) }}" class="btn btn-sm btn-success">Danh sách công việc</a>
                            {{-- @elseif(isset($studentTopic->topic) && checkTime($studentTopic->topic->tc_start_outline) > 0)
                                <a href="" class="btn btn-sm btn-success">Nộp : {{ formatTime($studentTopic->topic->tc_start_outline) }} - {{ formatTime($studentTopic->topic->tc_end_outline) }}</a> --}}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body" style="min-height: 142px">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Điểm quá trình</h5>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-trophy"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{--<p class="mt-3 mb-0 text-sm">--}}
                            {{--<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
                            {{--<span class="text-nowrap">Tỉ lệ đăng ký</span>--}}
                        {{--</p>--}}
                        <p class="mt-3 mb-0 text-sm col text-right">
                            <a href="{{ route('user.points.index', ['studentTopicId' => $studentTopic->id]) }}" class="btn btn-sm btn-success">Xem điểm quá trình</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
</div>
