<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('n_title') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tiêu đề thông báo <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tiêu đề thông báo" name="n_title" value="{{ old('n_title', isset($notification) ? $notification->n_title : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_title') }}</p></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" >
                                <label for="inputName2" class="col-form-label">Thông báo cho niên khóa</label>
                                <div>
                                    <select name="n_course_id" class="form-control">
                                        <option value="">Chọn niên khóa</option>
                                        @foreach($courses as $key => $course)
                                            <option  {{old('department_id', isset($notification) ? $notification->n_course_id : '') == $course->id ? 'selected=selected' : '' }}  value="{{$course->id}}">{{$course->c_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_course_id') }}</p></span>
                                </div>
                            </div>
                            <div class="form-group col-md-6" >
                                <label for="inputName2" class="col-form-label">Loại thông báo </label>
                                <div>
                                    <select name="n_type" class="form-control">
                                        @foreach($types as $key => $type)
                                            <option  {{old('n_type', isset($notification) ? $notification->n_type : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_type') }}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="inputName2" class="col-form-label">Đối tượng thông báo</label>
                            <div>
                                <select name="n_send_to" class="form-control">
                                    @foreach($sendTo as $key => $item)
                                        <option  {{old('n_send_to', isset($notification) ? $notification->n_send_to : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_send_to') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('users') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Gửi trực tiếp</label>
                            <div>
                                <select class="custom-select  select2" id="users" name="users[]" multiple>
                                    <option value="">Chọn giáo viên</option>
                                    @foreach($users as $key => $user)
                                        <option value="{{ $user->id }}"
                                                @if( null !== old('users') and in_array($user->id, old('users')) or isset($notificationUsers) and isset($notificationUsers) and in_array($user->id, $notificationUsers)) selected ="selected" @endif
                                        >{{  $user->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('teacher') }}</p></span>
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
                        <div style="margin-top: 15px;">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" name="n_status" value="1" {{ isset($notification->n_status) && $notification->n_status == 1 ? 'checked' : '' }} >
                                <label for="radioPrimary1">
                                    Đã duyệt
                                </label>
                            </div>
                            <div class="icheck-primary d-inline" style="margin-left: 30px;">
                                <input type="radio" id="radioPrimary2" name="n_status" value="2" {{ isset($notification->n_status) && $notification->n_status == 2 ? 'checked' : '' }} {{ !isset($topic) ? 'checked' : '' }}>
                                <label for="radioPrimary2">
                                    Chưa duyệt
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
