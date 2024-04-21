@extends('page.layouts.main')
@section('title')
@section('style')
    <script src="{!! asset('admin/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('admin/ckfinder/ckfinder.js') !!}"></script>
    <script src="{!! asset('admin/dist/js/func_ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/')!!}"
    </script>
@stop
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
                            <h3 class="mb-0" style="text-transform: uppercase;">TẠO MỚI LỊCH HẸN </h3>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('user.schedule.teacher') }}" class="btn btn-sm btn-primary">Danh sách</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    @include('page.schedule.form')
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop