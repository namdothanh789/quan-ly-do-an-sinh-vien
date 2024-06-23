@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('calendar.index', $topic->id) }}">Phân công công việc</a></li>
                        <li class="breadcrumb-item active">Đề tài : {{ $topic->topic->topic->t_title }} - Sinh viên : {{ $topic->student->name }}</li>
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
                                <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class="control-label default">Tiêu đề công việc <sup class="text-danger">(*)</sup></label>
                                    <div>
                                        <input type="text" class="form-control"  placeholder="Tiêu đề công việc" name="title" value="{{ old('title') }}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('title') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('type') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class="control-label default">Loại báo cáo <sup class="text-danger">(*)</sup></label>
                                    <div>
                                        <select name="type" class="form-control">
                                            <option  {{old('type') == 0 ? 'selected' : '' }}  value="0">Báo cáo nhiệm vụ</option>
                                            <option  {{old('type') == 1 ? 'selected' : '' }}  value="1">Báo cáo đồ án</option>
                                        </select>
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('type') }}</p></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group {{ $errors->first('start_date') ? 'has-error' : '' }} col-md-6">
                                        <label for="inputEmail3" class="control-label default">Ngày bắt đầu </label>
                                        <div>
                                            <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('start_date') }}</p></span>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('end_date') ? 'has-error' : '' }} col-md-6">
                                        <label for="inputEmail3" class="control-label default">Ngày kết thúc </label>
                                        <div>
                                            <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('end_date') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group {{ $errors->first('contents') ? 'has-error' : '' }}">
                                        <label for="inputName" class="col-sm-12 col-form-label">Nội dung công việc <sup class="text-danger">(*)</sup></label>
                                        <div class="col-sm-12">
                                            <textarea name="contents" id="contents" cols="30" rows="10" class="form-control">{!! old('contents') !!}</textarea>
                                            <script>
                                                ckeditor(contents);
                                            </script>
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('contents') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="student_topic_id" value="{{ $topic->id }}">
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
                                    <button type="submit" name="submit" value="create" class="btn btn-info">
                                        <i class="fa fa-save"></i> Lưu dữ liệu
                                    </button>
                                    <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
        
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Trạng thái</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <select name="status" class="form-control">
                                        @foreach($status as $key => $item)
                                            <option  {{old('status') == $key ? 'selected' : '' }}  value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('status') }}</p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop