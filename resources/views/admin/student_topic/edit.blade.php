@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.topics.index') }}">Danh sách đề tài</a></li>
                        <li class="breadcrumb-item active">Nhận xét file báo cáo</li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Tên file: {{ isset($calendar->resultFile) ? $calendar->resultFile->rf_title : '' }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title" style="color: #FFFFFF !important;">Đánh giá file báo cáo</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="{{ route('student.topics.update', $calendar->id) }}" method="post" enctype="multipart/form-data">
                                        <div class="form-group {{ $errors->first('rf_point') ? 'has-error' : '' }} col-md-6">
                                            <label for="inputName" class="col-sm-12 col-form-label">Trạng thái công việc :</label>
                                            <select name="status" class="form-control" id="inputName">
                                                @foreach($status as $key => $item)
                                                    <option  {{$calendar->status == $key ? 'selected' : '' }}  value="{{$key}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('status') }}</p></span>
                                        </div>
                                        <div class="form-group {{ $errors->first('rf_point') ? 'has-error' : '' }} col-md-6">
                                            <label for="inputName" class="col-sm-12 col-form-label">Điểm đề cương :</label>
                                            <div class="col-sm-12">
                                                <input type="number" step="0.1" class="form-control" id="inputName" name="rf_point" value="{{ isset($calendar->resultFile->rf_point) ? $calendar->resultFile->rf_point : '' }}" min="0">
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('rf_point') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->first('rf_comment') ? 'has-error' : '' }}">
                                            <label for="inputName" class="col-sm-12 col-form-label">Nhận xét</label>
                                            <div class="col-sm-12">
                                                <textarea name="rf_comment" id="rf_comment" cols="30" rows="10" class="form-control">{{ isset($calendar->resultFile->rf_comment) ? $calendar->resultFile->rf_comment : '' }}</textarea>
                                                <script>
                                                    ckeditor(rf_comment);
                                                </script>
                                            </div>
                                        </div>
                                        @csrf
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>
@stop