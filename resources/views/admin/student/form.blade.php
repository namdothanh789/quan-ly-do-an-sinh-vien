<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if(isset($user) && !empty($user->avatar))
                                <img src="{{ asset(pare_url_file($user->avatar)) }}" alt="" class=" margin-auto-div img-rounded profile-user-img img-fluid img-circle"  id="image_render" style="height: 150px; width:150px;">
                            @else
                                <img alt="" class="margin-auto-div img-rounded profile-user-img img-fluid img-circle" src="{{ asset('admin/dist/img/avatar5.png') }}" id="image_render" style="height: 150px; width:150px;">
                            @endif
                        </div>
                        @if (isset($user->name))
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        @endif
                        @if (isset($user->email))
                            <p class="text-muted text-center">{{ $user->email }}</p>
                        @endif
                        @if (isset($user->phone))
                            <p class="text-muted text-center">{{ $user->phone }}</p>
                        @endif
                        @if (isset($user->userRole))
                            <p class="text-muted text-center">{{ isset($user->userRole[0]) ? $user->userRole[0]->display_name : '' }}</p>
                        @endif
                        <div class="form-group">
                            <div class="input-group input-file" name="images">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-choose" type="button">Chọn tệp</button>
                                    </span>
                                <input type="text" class="form-control" placeholder='Không có tệp nào ...'/>
                                <span class="input-group-btn"></span>
                            </div>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('images') }}</p></span>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <?php //dd($errors) ?>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Mã sinh viên <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control random_code" id="inputName" placeholder="Mã sinh viên" oninput="if(value.length>15)value=value.slice(0,15)" name="code" value="{{old('code', isset($user->code) ? $user->code : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('code') }}</p></span>
                                    </div>
                                    <div class="col-sm-2 default mg-t-10 mg-b-10" style="display: inline-block">
                                        <button class="btn btn-blue btn-info btn-change btn-change-code" >Tạo mã</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Họ và tên  <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Họ và tên" name="name" value="{{old('name', isset($user->name) ? $user->name : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email  <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{old('email', isset($user->email) ? $user->email : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Mật khẩu  <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="password" class="form-control" value="" id="exampleInputEmail1" placeholder="Mật khẩu">
                                        @if (isset($user))
                                            <p class="text-danger">Để trống nếu không cập nhật mật khẩu</p>
                                        @endif
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Phone  <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2" placeholder="Phone" name="phone" value="{{old('phone', isset($user->phone) ? $user->phone : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label for="inputName2" class="col-sm-2 col-form-label">Khoa <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">

                                        <select name="department_id" class="form-control">
                                            <option value="">Chọn khoa</option>
                                            @foreach($departments as $key => $department)
                                                @if ($department->parents->isNotEmpty())
                                                    <optgroup label="{{ $department->dp_name }}">
                                                        @foreach($department->parents as $parent)
                                                            <option {{old('department_id', isset($user) ? $user->department_id : '') == $parent->id ? 'selected=selected' : '' }}  value="{{$parent->id}}">{{$parent->dp_name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <option
                                                            {{old('department_id', isset($user->department_id) ? $user->department_id : '') == $department->id ? 'selected="selected"' : ''}}
                                                            value="{{$department->id}}"
                                                    >
                                                        {{$department->dp_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('gender') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label for="inputName2" class="col-sm-2 col-form-label">Niên khóa <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <select name="course_id" class="form-control">
                                            <option value="">Chọn niên khóa</option>
                                            @foreach($courses as $key => $course)
                                                <option  {{old('department_id', isset($user) ? $user->course_id : '') == $course->id ? 'selected=selected' : '' }}  value="{{$course->id}}">{{$course->c_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('gender') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label for="inputName2" class="col-sm-2 col-form-label">Giới tính <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <select name="gender" class="form-control">
                                            <option value="">Chọn giới tính</option>
                                            @foreach($gender as $key => $item)
                                                <option  {{old('gender', isset($user) ? $user->gender : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('gender') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Địa chỉ </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2" placeholder="Địa chỉ" name="address" value="{{old('address', isset($user->address) ? $user->address : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('address') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Điểm trung bình </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2" placeholder="Điểm trung bình vd(9.5)" name="point_medium" value="{{old('point_medium', isset($user->point_medium) ? $user->point_medium : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('point_medium') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Ngày sinh</label>
                                    <div class="col-10">
                                        <input name="birthday" type="date" class="form-control" value="{{ old('birthday', isset($user->birthday) ? date('Y-m-d',strtotime($user->birthday)) : '') }}">
                                        @if ($errors->first('birthday'))
                                            <span class="text-danger">{{ $errors->first('birthday') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Trạng thái  </label>
                                    <div class="col-sm-10">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary1" name="status" value="1" {{ isset($user->status) && $user->status == 1 ? 'checked' : '' }} >
                                            <label for="radioPrimary1">
                                                Đã duyệt
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline" style="margin-left: 30px;">
                                            <input type="radio" id="radioPrimary2" name="status" value="2" {{ isset($user->status) && $user->status == 2 ? 'checked' : '' }} {{ !isset($user) ? 'checked' : '' }}>
                                            <label for="radioPrimary2">
                                                Chưa duyệt
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-info" value="{{ isset($user) ? 'update' : 'create' }}">
                                            <i class="fa fa-save"></i> Lưu dữ liệu
                                        </button>
                                        <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                            <i class="fa fa-undo"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>
