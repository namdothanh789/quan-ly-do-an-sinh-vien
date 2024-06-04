@extends('admin.layouts.main_auth')
@section('title')
@section('content')
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href=""><b>Xác nhận thông tin lịch hẹn </b></a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">Giáo viên : {{ $userCheck->name }}</div>

        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            Cám ơn bạn đã xác nhận : {{ $title }}
        </div>
        <div class="text-center">
            @php
                $user = Auth::user();
            @endphp
            @if ($user)
                <a href="{{ route('home')}}">Truy cập trang quản trị</a>
            @else
                <a href="{{ route('admin.login') }}">Đăng nhập để sử dụng</a>
            @endif
        </div>
    </div>
    <!-- /.center -->
@stop