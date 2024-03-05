<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('dp_name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên khoa / bộ môn <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Tên phòng ban" name="dp_name" value="{{ old('dp_name',isset($department) ? $department->dp_name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('dp_name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Trực thuộc</label>
                            <select class="custom-select" name="dp_parent_id">
                                <option value="0">Trực thuộc khoa</option>
                                @foreach($parents as $parent)
                                    <option
                                            {{old('dp_parent_id', isset($department->dp_parent_id) ? $department->dp_parent_id : '') == $parent->id ? 'selected="selected"' : ''}}
                                            value="{{$parent->id}}"
                                    >
                                        {{$parent->dp_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{ $errors->first('dp_content') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Mô tả </label>
                            <div>
                                <textarea name="dp_content" style="resize:vertical" class="form-control" placeholder="Mô tả sơ qua về nhóm quyền ...">{{ old('dp_content',isset($department) ? $department->dp_content : '') }}</textarea>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('dp_content') }}</p></span>
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
