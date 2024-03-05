<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('co_title') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên hội đồng <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Tên hội đồng" name="co_title" value="{{ old('co_title',isset($council) ? $council->co_title : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('co_title') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('teacher') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Danh sách hội đồng <sup class="text-danger">(*)</sup></label>
                            <div>
                                <select class="custom-select select2" name="teachers[]" multiple>
                                    <option value="">Chọn giáo viên</option>
                                    @foreach($teachers as $key => $teacher)
                                        <option value="{{ $teacher->id }}"
                                                @if( null !== old('teachers') and in_array($teacher->id, old('teachers')) or isset($council) and isset($teacherCouncils) and in_array($teacher->id, $teacherCouncils)) selected ="selected" @endif
                                        >{{  $teacher->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('teacher') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('co_content') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Quyết định thành lập <sup class="text-danger">(*)</sup></label>
                            <div>
                                <textarea name="co_content" id="co_content" style="resize:vertical" class="form-control" placeholder="Quyết định thành lập ">{{ old('co_content',isset($council) ? $council->co_content : '') }}</textarea>
                                <script>
                                    ckeditor(co_content);
                                </script>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('co_content') }}</p></span>
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
                        <h3 class="card-title">Niên khóa <sup class="text-danger">(*)</sup></h3>
                    </div>
                    <div class="card-body">
                        <div style="margin-top: 15px;">
                            <select name="co_course_id" class="form-control">
                                <option value="">Chọn niên khóa</option>
                                @foreach($courses as $key => $course)
                                    <option  {{old('co_course_id', isset($council) ? $council->co_course_id : '') == $course->id ? 'selected=selected' : '' }}  value="{{$course->id}}">{{$course->c_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('gt_course_id') }}</p></span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trạng thái</h3>
                    </div>
                    <div class="card-body">
                        <div style="margin-top: 15px;">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" name="co_status" value="1" {{ isset($council->co_status) && $council->co_status == 1 ? 'checked' : '' }} >
                                <label for="radioPrimary1">
                                    Đã duyệt
                                </label>
                            </div>
                            <div class="icheck-primary d-inline" style="margin-left: 30px;">
                                <input type="radio" id="radioPrimary2" name="co_status" value="2" {{ isset($council->co_status) && $council->co_status == 2 ? 'checked' : '' }} {{ !isset($council) ? 'checked' : '' }}>
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
