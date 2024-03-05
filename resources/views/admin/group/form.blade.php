<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên nhóm sinh viên <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tên nhóm sinh viên" name="name" value="{{ old('name', isset($group) ? $group->name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('students') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Danh sách sinh viên <sup class="text-danger">(*)</sup></label>
                            <div>
                                <select class="custom-select select2" name="students[]" multiple>
                                    <option value="">Chọn sinh viên</option>
                                    @foreach($students as $key => $student)
                                        <option value="{{ $student->id }}"
                                                @if( null !== old('students') and in_array($student->id, old('students')) or isset($group) and isset($studentGroup) and in_array($student->id, $studentGroup)) selected ="selected" @endif
                                        >{{  $student->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('students') }}</p></span>
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
