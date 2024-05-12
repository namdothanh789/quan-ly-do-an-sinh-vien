<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('n_title') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tiêu đề <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tiêu đề" name="n_title" value="{{ old('n_title', isset($notification) ? $notification->n_title : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_title') }}</p></span>
                            </div>
                        </div>
                       <div class="row">
                           <div class="form-group {{ $errors->first('users') ? 'has-error' : '' }} col-md-6">
                               <label for="inputEmail3" class="control-label default">Chọn giáo viên <sup class="text-danger">(*)</sup></label>
                               <div>
                                   <select class="form-control" id="users" name="teacher_id">
                                       <option value="">Chọn giáo viên</option>
                                       @foreach($users as $key => $user)
                                           <option value="{{ $user->id }}"
                                           @if(isset($notification->notificationUsers))
                                               @foreach($notification->notificationUsers as $item)
                                                   {{ $user->id == $item->user->id ? 'selected' : ''}}
                                                       @endforeach
                                                   @endif
                                           >
                                               {{  $user->name }}
                                           </option>
                                       @endforeach
                                   </select>
                                   <span class="text-danger "><p class="mg-t-5">{{ $errors->first('teacher_id') }}</p></span>
                               </div>
                           </div>
                           <div class="form-group col-md-6" >
                               <label for="inputName2" class="col-form-label default">Loại cuộc hẹn </label>
                               <div>
                                   <select name="n_schedule_type" class="form-control">
                                       @foreach($schedule_types as $key => $type)
                                           <option  {{old('n_schedule_type', isset($notification) ? $notification->n_schedule_type : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$type}}</option>
                                       @endforeach
                                   </select>
                                   <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_schedule_type') }}</p></span>
                               </div>
                           </div>
                       </div>
                        <div class="row">
                            <div class="form-group col-md-6" >
                                <label for="inputName2" class="col-form-label">Thời gian bắt đầu <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="datetime-local" name="n_from_date" class="form-control" value="{{ isset($notification) ? $notification->n_from_date : '' }}">
                                </div>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_from_date') }}</p></span>
                            </div>

                            <div class="form-group col-md-6" >
                                <label for="inputName2" class="col-form-label">Thời gian kết thúc <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="datetime-local" name="n_end_date" class="form-control" value="{{ isset($notification) ? $notification->n_end_date : '' }}">
                                </div>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_end_date') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('n_content') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Nội dung <sup class="text-danger">(*)</sup></label>
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
                </div>
            </div>
        </div>
    </form>
</div>
