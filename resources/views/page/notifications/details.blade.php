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
            <div class="col-xl-12">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col" style="flex-basis: unset !important;">
                            <h3 class="mb-0" style="text-transform: uppercase;">THÔNG BÁO : {{ $notification->n_title }}</h3>
                        </div>
                        <div class="col text-right">

                        </div>
                    </div>
                </div>
                <div class="col=md-12">
                    <div class="card-body">
                        @if ($notification->n_from_date)
                            <p>Lịch hẹn vào ngày : {{ date('Y-m-d', strtotime($notification->n_from_date)) }} giờ : {{ date('H:i', strtotime($notification->n_from_date)) }}</p>
                        @endif
                        {!! $notification->n_content !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop