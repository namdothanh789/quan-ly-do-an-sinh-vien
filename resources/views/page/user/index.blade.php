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
                                                <h3 class="mb-0" style="text-transform: uppercase">Thông tin tài khoản </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form role="form" action="{{ route('update.user.profile') }}" method="post" enctype="multipart/form-data">
                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username" style="float: left;">Mã sinh viên</label>
                                                            <input type="text" id="input-username" class="form-control" value="{{ $user->code }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-email" style="float: left;">Email</label>
                                                            <input type="email" id="input-email" class="form-control" value="{{ $user->email }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-first-name" style="float: left;">Họ và tên <sup class="title-sup">(*)</sup></label>
                                                            <input type="text" id="input-first-name" name="name" class="form-control" value="{{ old('name', isset($user->name) ? $user->name : '') }}">
                                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-last-name" style="float: left;">Phone <sup class="title-sup">(*)</sup></label>
                                                            <input type="text" id="input-last-name" name="phone"  class="form-control" value="{{ old('phone', isset($user->phone) ? $user->phone : '') }}">
                                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-first-name" style="float: left;">Địa chỉ <sup class="title-sup">(*)</sup></label>
                                                            <input type="text" id="input-first-name" name="address" class="form-control" value="{{ old('address', isset($user->address) ? $user->address : '') }}">
                                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('address') }}</p></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-last-name" style="float: left;">Ngày sinh <sup class="title-sup">(*)</sup></label>
                                                            <input type="date" id="input-last-name" name="birthday"  class="form-control" value="{{ old('birthday', isset($user->birthday) ? date('Y-m-d',strtotime($user->birthday)) : '') }}">
                                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('birthday') }}</p></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-first-name" style="float: left;">Avatar</label>
                                                            <input type="file" id="input-first-name" name="images" class="form-control">
                                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('images') }}</p></span>
                                                            <div style="float: left;">
                                                                @if(isset($user) && !empty($user->avatar))
                                                                    <img src="{{ asset(pare_url_file($user->avatar)) }}" alt="" class=" margin-auto-div img-rounded profile-user-img img-fluid img-circle"  id="image_render" style="height: 150px; width:150px;">
                                                                @else
                                                                    <img alt="" class="margin-auto-div img-rounded profile-user-img img-fluid img-circle" src="{{ asset('admin/dist/img/avatar5.png') }}" id="image_render" style="height: 150px; width:150px;">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group" >
                                                            <label for="input-first-name" class="form-control-label" style="float: left;">Giới tính </label>
                                                            <select name="gender" class="form-control">
                                                                <option value="">Chọn giới tính</option>
                                                                @foreach($gender as $key => $item)
                                                                    <option  {{old('gender', isset($user) ? $user->gender : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$item}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('gender') }}</p></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @csrf
                                            <div>
                                                <button type="submit" class="btn btn-primary text-right"> Cập nhật thông tin</button>
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