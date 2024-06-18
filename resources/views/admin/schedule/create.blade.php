@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('schedule.student.index') }}">Lịch hẹn</a></li>
                        <li class="breadcrumb-item active">Tạo mới</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-primary">
                            <!-- form start -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group {{ $errors->first('n_title') ? 'has-error' : '' }} col-md-6">
                                        <label for="inputEmail3" class="col-form-label">Tiêu đề <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <input type="text" maxlength="100" class="form-control"  placeholder="Tiêu đề lịch hẹn" name="n_title" value="{{ old('n_title', isset($notification) ? $notification->n_title : '') }}">
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_title') }}</p></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" >
                                        <label for="inputName2" class="col-form-label">Chọn đề tài </label>
                                        <div>
                                            <select name="topic_id" class="form-control">
                                                @foreach($topics as $topic)
                                                    <option  {{old('topic_id') == $topic->id ? 'selected' : '' }}  value="{{$topic->id}}">{{$topic->t_title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_schedule_type') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6" >
                                        <label for="inputName2" class="col-form-label">Loại cuộc hẹn </label>
                                        <div>
                                            <select name="n_schedule_type" class="form-control">
                                                @foreach($schedule_types as $key => $type)
                                                    <option  {{old('n_schedule_type', isset($notification) ? $notification->n_schedule_type : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_schedule_type') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group {{ $errors->first('users') ? 'has-error' : '' }} col-md-6">
                                        <label for="inputEmail3" class="control-label default">Danh sách tham gia <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <select class="custom-select  select2" id="users" name="users[]" multiple>
                                                <option value="">Chọn người tham gia</option>
                                                @foreach($users as $key => $user)
                                                    <option value="{{ $user->id }}"
                                                            @if( null !== old('users') and in_array($user->id, old('users')) or isset($notificationUsers) and isset($notificationUsers) and in_array($user->id, $notificationUsers)) selected ="selected" @endif
                                                    >{{  $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('users') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inputName2" class="col-form-label">Thời gian bắt đầu <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <input type="datetime-local" name="n_from_date" class="form-control" value="{{ isset($notification) ? $notification->n_from_date : '' }}">
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_from_date') }}</p></span>
                                        </div>
                                    </div>
        
                                    <div class="form-group col-md-6">
                                        <label for="inputName2" class="col-form-label">Thời gian kết thúc <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <input type="datetime-local" name="n_end_date" class="form-control" value="{{ isset($notification) ? $notification->n_end_date : '' }}">
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_end_date') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('n_content') ? 'has-error' : '' }}">
                                    <label for="inputEmail3" class="control-label default">Nội dung thông báo <sup class="text-danger">(*)</sup></label>
                                    <div>
                                        <textarea name="n_content" id="n_content" style="resize:vertical" class="form-control" placeholder="Mô tả chức vụ ...">{{ old('n_content', isset($notification) ? $notification->n_content : '') }}</textarea>
                                        <script>
                                            ckeditor(n_content);
                                        </script>
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_content') }}</p></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Xuất bản</h3>
                            </div>
                            <div class="card-body">
                                <div class="btn-set">
                                    <button type="submit" name="submit" class="btn btn-info">
                                        <i class="fa fa-save"></i> Lưu dữ liệu
                                    </button>
                                    <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </div>
        
                            <div class="card-header">
                                <h3 class="card-title">Trạng thái</h3>
                            </div>
                            <div class="card-body">
                                {{--<div style="margin-top: 15px;">--}}
                                    {{--<div class="icheck-primary d-inline">--}}
                                        {{--<input type="radio" id="radioPrimary1" name="n_status" value="1" {{ isset($notification->n_status) && $notification->n_status == 1 ? 'checked' : '' }} >--}}
                                        {{--<label for="radioPrimary1">--}}
                                            {{--Đã họp--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="icheck-primary d-inline" style="margin-left: 30px;">--}}
                                        {{--<input type="radio" id="radioPrimary2" name="n_status" value="2"--}}
                                                {{--{{ isset($notification->n_status) && $notification->n_status == 2 ? 'checked' : '' }}--}}
                                                {{--{{ !isset($notification) ? 'checked' : '' }}--}}
                                        {{-->--}}
                                        {{--<label for="radioPrimary2">--}}
                                            {{--Chưa họp--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop