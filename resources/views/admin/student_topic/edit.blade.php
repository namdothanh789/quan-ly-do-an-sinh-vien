@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="">Thông tin đăng ký đề tài</a></li>

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
                    <h3 class="card-title">{{ isset($student->topic) ? $student->topic->topic->t_title : '' }}</h3>

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
                                    <h3 class="card-title" style="color: #FFFFFF !important;">Đánh giá đề tài</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="{{ route('update.student.topic', $student->id) }}" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="inputName" class="col-sm-12 col-form-label">Điểm bảo vệ :</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" step="0.01" class="form-control" id="inputName" name="st_point" value="{{ old('st_point', isset($student) ? $student->st_point : 0) }}">
                                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('st_point') }}</p></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group ">
                                                    <label for="inputName" class="col-sm-12 col-form-label">Trạng thái :</label>
                                                    <div class="col-sm-12">
                                                        <select name="st_status" class="form-control">
                                                            @foreach($status as $key => $item)
                                                                <option  {{old('st_status', isset($student) ? $student->st_status : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$item}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('st_status') }}</p></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-12 col-form-label">Nhận sét</label>
                                                <div class="col-sm-12">
                                                    <textarea name="st_comments" id="st_comments" cols="30" rows="10" class="form-control">{!! $student->st_comments !!}</textarea>
                                                    <script>
                                                        ckeditor(st_comments);
                                                    </script>
                                                </div>
                                            </div>
                                            @csrf
                                            <div class="col-12">
                                                <button type="submit" name="topic" value="topic" class="btn btn-primary" style="float: right">Cập nhật</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title" style="color: #FFFFFF !important;">Thông Tin Đề Cương</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="{{ route('student.update.outline', $student->id) }}" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-12 col-form-label">Chọn đề cương : <sup class="title-sup">(*)</sup></label>
                                            <div class="col-sm-12">
                                                {{--<input type="text" class="form-control" id="inputName" placeholder="Tên đề cương" name="st_outline" value="{{ old('st_outline', isset($student) ? $student->st_outline : '') }}">--}}
                                                <select name="result_outline_file_id" id="" class="form-control">
                                                    <option value="">Chọn đề cương cần nhận sét</option>
                                                    @foreach($student->result_outline_files as $outline_file)
                                                        <option value="{{ $outline_file->id }}">{{ $outline_file->rf_title }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('result_outline_file_id') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="inputName" class="col-sm-12 col-form-label">Điểm đề cương :</label>
                                            <div class="col-sm-12">
                                                <input type="number" step="0.01" class="form-control" id="inputName" name="rf_point" value="">
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('rf_point') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-12 col-form-label">Trạng thái :</label>
                                            <div class="col-sm-12">
                                                <select name="rf_status" class="form-control">
                                                    @foreach($status_outline as $key => $status)
                                                        <option value="{{$key}}">{{$status}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('rf_status') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-12 col-form-label">File phản hồi</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="inputName" placeholder="" name="outline_part" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-12 col-form-label">Nhận sét</label>
                                            <div class="col-sm-12">
                                                <textarea name="rf_comment" id="rf_comment" cols="30" rows="10" class="form-control"></textarea>
                                                <script>
                                                    ckeditor(rf_comment);
                                                </script>
                                            </div>
                                        </div>
                                        @csrf
                                        <div class="form-group text-right">
                                            <button type="submit" name="outline" value="outline" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title" style="color: #FFFFFF !important;">Thông Tin Đồ Án</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form" action="{{ route('student.update.thesis.book', $student->id) }}" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-12 col-form-label">Chọn báo cáo : <sup class="title-sup">(*)</sup></label>
                                            <div class="col-sm-12">
                                                {{--<input type="text" class="form-control" id="inputName" placeholder="Tên đồ án" name="st_thesis_book" value="{{ old('st_thesis_book', isset($student) ? $student->st_thesis_book : '') }}">--}}
                                                <select name="result_book_file_id" id="" class="form-control">
                                                    <option value="">Chọn báo cáo</option>
                                                    @foreach($student->result_book_files as $book_file)
                                                        <option value="{{ $book_file->id }}">{{ $book_file->rf_title }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('result_book_file_id') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="inputName" class="col-sm-12 col-form-label">Điểm đồ án :</label>
                                            <div class="col-sm-12">
                                                <input type="number" step="0.01" class="form-control" id="inputName" placeholder="Điểm" name="rf_point" value="">
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('rf_point') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="inputName" class="col-sm-12 col-form-label">Trạng thái :</label>
                                            <div class="col-sm-12">
                                                <select name="rf_status" class="form-control">
                                                    @foreach($status_outline as $key => $status)
                                                        <option value="{{$key}}">{{$status}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('rf_status') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="inputName" class="col-sm-12 col-form-label">File đính kèm</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="inputName" placeholder="" name="thesis_book_part" value="">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="inputName" class="col-sm-12 col-form-label">Nhận sét</label>
                                            <div class="col-sm-12">
                                                <textarea name="rf_comment" id="rf_book_comment" cols="30" rows="10" class="form-control"></textarea>
                                                <script>
                                                    ckeditor(rf_book_comment);
                                                </script>
                                            </div>
                                        </div>
                                        @csrf
                                        <div class="form-group text-right">
                                            <button type="submit" name="book" value="book" class="btn btn-primary">Cập nhật</button>
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