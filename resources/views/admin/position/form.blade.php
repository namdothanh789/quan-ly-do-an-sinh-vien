<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('p_name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên chức vụ <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tên chức vụ" name="p_name" value="{{ old('p_name', isset($position) ? $position->p_name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('p_name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('p_content') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Mô tả chức vụ</label>
                            <div>
                                <textarea name="p_content" style="resize:vertical" class="form-control" placeholder="Mô tả chức vụ ...">{{ old('p_content', isset($position) ? $position->p_content : '') }}</textarea>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('p_content') }}</p></span>
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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
