<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('t_title') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên đề tài <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tên đề tài" name="t_title" value="{{ old('t_title',isset($topic) ? $topic->t_title : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('t_title') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('t_department_id') ? 'has-error' : '' }}" >
                            <label for="inputName2" class="control-label default">Khoa / Bộ môn <sup class="title-sup">(*)</sup></label>
                            <div>
                                <select name="t_department_id" class="form-control">
                                    <option value="">Chọn khoa / bộ môn</option>
                                    @foreach($departments as $key => $department)
                                        @if ($department->parents->isNotEmpty())
                                        <optgroup label="{{ $department->dp_name }}">
                                            @foreach($department->parents as $parent)
                                                <option {{old('t_department_id', isset($topic) ? $topic->t_department_id : '') == $parent->id ? 'selected=selected' : '' }}  value="{{$parent->id}}">{{$parent->dp_name}}</option>
                                            @endforeach
                                        </optgroup>
                                        @else
                                            <option
                                                    {{old('t_department_id', isset($topic->t_department_id) ? $topic->t_department_id : '') == $department->id ? 'selected="selected"' : ''}}
                                                    value="{{$department->id}}"
                                            >
                                                {{$department->dp_name}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('t_department_id') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('t_content') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default" style="margin-bottom: 15px">Mô tả chi tiết</label>
                            <div>
                                <textarea name="t_content" style="resize:vertical" id="t_content" class="form-control" placeholder="Mô tả chi tiết đề tài ...">{{ old('t_content',isset($topic) ? $topic->t_content : '') }}</textarea>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('t_content') }}</p></span>
                                <script>
                                    ckeditor(t_content);
                                </script>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trạng thái</h3>
                    </div>
                    <div class="card-body">
                        <div style="margin-top: 15px;">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" name="t_status" value="1" {{ isset($topic->t_status) && $topic->t_status == 1 ? 'checked' : '' }} >
                                <label for="radioPrimary1">
                                    Đã duyệt
                                </label>
                            </div>
                            <div class="icheck-primary d-inline" style="margin-left: 30px;">
                                <input type="radio" id="radioPrimary2" name="t_status" value="2" {{ isset($topic->t_status) && $topic->t_status == 2 ? 'checked' : '' }} {{ !isset($topic) ? 'checked' : '' }}>
                                <label for="radioPrimary2">
                                    Chưa duyệt
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
