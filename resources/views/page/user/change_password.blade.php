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
    <div class="container-fluid mt--6">
        <div class="row mt--5">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="card card-upgrade">
                    <div class="card-header text-center border-bottom-0">
                        <div class="row">
                            <div class="col-xl-12 order-xl-1">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h3 class="mb-0" style="text-transform: uppercase">Đổi mật khẩu </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form role="form" action="{{ route('user.post.change.password') }}" method="post" enctype="multipart/form-data">
                                            <div class="pl-lg-4">
                                                <div class="row text-center">
                                                    <div class="col-lg-6" style="margin: auto;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username" style="float: left;">Mật khẩu hiện tại <sup class="title-sup">(*)</sup></label>
                                                            <input type="password" id="input-username" class="form-control" name="current_password" value="">
                                                            <span class="text-danger text-left"><p class="mg-t-5">{{ $errors->first('current_password') }}</p></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-email" style="float: left;">Mật khẩu mới <sup class="title-sup">(*)</sup></label>
                                                            <input type="password" id="input-email" class="form-control" name="password" value="" >
                                                            <span class="text-danger text-left"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-email" style="float: left;">Nhập lại mật khẩu <sup class="title-sup">(*)</sup></label>
                                                            <input type="password" id="input-email" class="form-control" name="r_password" value="" >
                                                            <span class="text-danger text-left"><p class="mg-t-5">{{ $errors->first('r_password') }}</p></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            @csrf
                                            <div>
                                                <button type="submit" class="btn btn-primary text-right">Đổi mật khẩu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop