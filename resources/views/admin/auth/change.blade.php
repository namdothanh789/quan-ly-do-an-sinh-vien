@extends('admin.layouts.main')
@section('title', '')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item">Đổi mật khẩu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('admin.post.change.password')}}">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-primary">
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                                    <label for="exampleInputEmail1">Mật khẩu  <sup class="title-sup">(*)</sup></label>
                                    <input type="password" name="current_password" class="form-control" value="">
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('current_password') }}</p></span>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="exampleInputEmail1">Mật khẩu  <sup class="title-sup">(*)</sup></label>
                                    <input type="password" name="password" class="form-control" value="">
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
                                </div>

                                <div class="form-group {{ $errors->has('r_password') ? 'has-error' : '' }}">
                                    <label for="exampleInputEmail1">Mật khẩu  <sup class="title-sup">(*)</sup></label>
                                    <input type="password" name="r_password" class="form-control" value="" >
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('r_password') }}</p></span>
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
                                        <i class="fa fa-save"></i> Đổi mật khẩu
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
    </section>

@endsection