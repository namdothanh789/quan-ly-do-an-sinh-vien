<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary" style="height: 655px;">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Đề tài<sup class="text-danger">(*)</sup></label>
                            <select class="custom-select select2" name="tc_topic_id">
                                <option value="">Chọn đề tài</option>
                                @foreach($topics as $topic)
                                    <option {{old('tc_topic_id', isset($topicCourse->tc_topic_id) ? $topicCourse->tc_topic_id : '') == $topic->id ? 'selected="selected"' : ''}} value="{{$topic->id}}">
                                        {{$topic->t_title}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_topic_id') }}</p></span>
                        </div>
                        <div class="form-group">
                            <label>Niên khóa <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="tc_course_id">
                                <option value="">Chọn niên khóa</option>
                                @foreach($courses as $course)
                                    <option
                                            {{old('tc_course_id', isset($topicCourse->tc_course_id) ? $topicCourse->tc_course_id : '') == $course->id ? 'selected="selected"' : ''}}
                                            value="{{$course->id}}"
                                    >
                                        {{$course->c_name}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_course_id') }}</p></span>
                        </div>
                        <div class="form-group">
                            <label>Khoa / Bộ môn <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="tc_department_id">
                                <option value="">Chọn khoa bộ môn</option>
                                @foreach($departments as $key => $department)
                                    @if ($department->parents->isNotEmpty())
                                        <optgroup label="{{ $department->dp_name }}">
                                            @foreach($department->parents as $parent)
                                                <option {{old('tc_department_id', isset($topicCourse) ? $topicCourse->tc_department_id : '') == $parent->id ? 'selected=selected' : '' }}  value="{{$parent->id}}">{{$parent->dp_name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @else
                                        <option
                                                {{old('tc_department_id', isset($topicCourse) ? $topicCourse->tc_department_id : '') == $department->id ? 'selected="selected"' : ''}}
                                                value="{{$department->id}}"
                                        >
                                            {{$department->dp_name}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_department_id') }}</p></span>
                        </div>
                        <div class="form-group">
                            <label>Hội đồng <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="tc_council_id">
                                <option value="">Chọn hội đồng</option>
                                @foreach($councils as $council)
                                    <option
                                            {{old('tc_course_id', isset($topicCourse->tc_council_id) ? $topicCourse->tc_council_id : '') == $council->id ? 'selected="selected"' : ''}}
                                            value="{{$council->id}}"
                                    >
                                        {{$council->co_title}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_council_id') }}</p></span>
                        </div>

                        <div class="form-group">
                            <label>Giáo viên HD <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="tc_teacher_id">
                                <option value="">Chọn giáo viên</option>
                                @foreach($teachers as $teacher)
                                    <option
                                            {{old('tc_teacher_id', isset($topicCourse->tc_teacher_id) ? $topicCourse->tc_teacher_id : '') == $teacher->id ? 'selected="selected"' : ''}}
                                            value="{{$teacher->id}}"
                                    >
                                        {{$teacher->name}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_teacher_id') }}</p></span>
                        </div>
                        <div class="form-group {{ $errors->first('tc_registration_number') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Số sinh viên tối đa đăng ký <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="number" maxlength="100" class="form-control"  placeholder="Số sinh viên tối đa đăng ký" name="tc_registration_number" value="{{ old('tc_registration_number',isset($topicCourse) ? $topicCourse->tc_registration_number : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('tc_registration_number') }}</p></span>
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
                            <button type="submit" name="submit" value="{{ isset($topicCourse) ? 'update' : 'create' }}" class="btn btn-info">
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
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('tc_start_outline') ? 'has-error' : '' }} col-md-12">
                            <label for="inputEmail3" class="control-label default">Ngày bắt đầu nộp đề cương  <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="datetime-local" class="form-control" name="tc_start_outline" value="{{ old('tc_start_outline', isset($topicCourse) ? convertDatetimeLocal($topicCourse->tc_start_outline) : '') }}">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_start_outline') }}</p></span>
                            </div>

                        </div>
                        <div class="form-group {{ $errors->first('tc_end_outline') ? 'has-error' : '' }} col-md-12">
                            <label for="inputEmail3" class="control-label default">Ngày kết thúc nộp đề cương <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="datetime-local" class="form-control" name="tc_end_outline" value="{{ old('tc_end_outline', isset($topicCourse) ? convertDatetimeLocal($topicCourse->tc_end_outline) : '') }}">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_end_outline') }}</p></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('tc_start_thesis_book') ? 'has-error' : '' }} col-md-12">
                            <label for="inputEmail3" class="control-label default">Ngày bắt đầu nộp báo cáo  <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="datetime-local" class="form-control" name="tc_start_thesis_book" value="{{ old('tc_start_thesis_book', isset($topicCourse) ? convertDatetimeLocal($topicCourse->tc_start_thesis_book) : '') }}">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_start_thesis_book') }}</p></span>
                            </div>

                        </div>
                        <div class="form-group {{ $errors->first('tc_end_thesis_book') ? 'has-error' : '' }} col-md-12">
                            <label for="inputEmail3" class="control-label default">Ngày kết thúc nộp báo cáo <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="datetime-local" class="form-control" name="tc_end_thesis_book" value="{{ old('tc_end_thesis_book', isset($topicCourse) ? convertDatetimeLocal($topicCourse->tc_end_thesis_book) : '') }}">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tc_end_thesis_book') }}</p></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Trạng thái</h3>
                    </div>
                    <div class="card-body">
                        <div style="margin-top: 15px;">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" name="tc_status" value="1" {{ isset($topicCourse->tc_status) && $topicCourse->tc_status == 1 ? 'checked' : '' }} >
                                <label for="radioPrimary1">
                                    Đã duyệt
                                </label>
                            </div>
                            <div class="icheck-primary d-inline" style="margin-left: 30px;">
                                <input type="radio" id="radioPrimary2" name="tc_status" value="2" {{ isset($topicCourse->tc_status) && $topicCourse->tc_status == 2 ? 'checked' : '' }} {{ !isset($topicCourse) ? 'checked' : '' }}>
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
