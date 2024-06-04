@extends('page.layouts.main_auth')
@section('title')
@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-9 px-5">
                <h1 class="text-white">Xác nhận {{ $title }} thành công</h1>
                <p class="text-lead text-white">Vui lòng đăng nhập tại đây để cập nhật thông tin
                    <?php
                        $user = Auth::guard('students')->user();
                    ?>
                    @if (isset($user))
                        <a href="{{ route('user.home') }}" class="font-weight-bold ml-1" style="color: white">Tài khoản</a>
                    @else
                        <a href="{{ route('user.login') }}" class="font-weight-bold ml-1" style="color: white">Đăng nhập</a>
                    @endif
                </p>
            </div>
        </div>
    </div>
@stop