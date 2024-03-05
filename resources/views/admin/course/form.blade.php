<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('c_name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Niên khóa <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="2012-2019" name="c_name" value="{{ old('c_name',isset($course) ? $course->c_name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('c_name') }}</p></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group {{ $errors->first('c_start_time') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Ngày đăng ký đề tài <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="datetime-local" class="form-control" name="c_start_time" value="{{ old('c_start_time', isset($course) ? convertDatetimeLocal($course->c_start_time) : '') }}">
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('c_start_time') }}</p></span>
                                </div>

                            </div>
                            <div class="form-group {{ $errors->first('c_end_time') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Ngày kết thúc đăng ký <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="datetime-local" class="form-control" name="c_end_time" value="{{ old('c_end_time', isset($course) ? convertDatetimeLocal($course->c_end_time) : '') }}">
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('c_end_time') }}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <span> Thời gian ở đây để xác định thời gian đăng ký đề tài của niên khóa </span>
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
                            <button type="submit" name="submit" class="btn btn-info" value="{{ isset($course) ? 'update' : 'create' }}">
                                <i class="fa fa-save"></i> Lưu dữ liệu
                            </button>
                            <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                <i class="fa fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
