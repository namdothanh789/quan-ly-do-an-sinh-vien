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
                                <h3 class="mb-0" style="text-transform: uppercase;">CHI TIẾT CÔNG VIỆC : {{ $calendar->title }}</h3>
                            </div>
                            <div class="col text-right">
                                {{--<a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>Thời gian : {{ $calendar->start_date }} đến {{ $calendar->end_date }}</p>
                        <p>Nội dung : </p>
                        {!! $calendar->contents !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop