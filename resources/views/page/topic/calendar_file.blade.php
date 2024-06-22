@extends('page.layouts.main')
@section('title')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
            @include('page.common.breadcrumb')
            <!-- Card stats -->
                @include('page.common.topic_user')
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col" style="flex-basis: unset !important;">
                            <h3 class="mb-0" style="text-transform: uppercase;">
                                @if($calendar->type == 0)
                                    NỘP FILE BÁO CÁO
                                @elseif($calendar->type == 1)
                                    NỘP FILE ĐỒ ÁN
                                @endif
                            </h3>
                        </div>
                        <div class="col text-right">
                            {{--<a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('file.result', $calendar->id) }}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->first('rf_title') ? 'has-error' : '' }}">
                                        <label class="form-control-label" for="input-title" style="float: left;">Tiêu đề <sup class="title-sup">(*)</sup></label>
                                        <input type="text" id="input-title" name="rf_title" class="form-control" value="{{ old('rf_title') }}">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('rf_title') }}</p></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->first('rf_path') ? 'has-error' : '' }}">
                                        <label class="form-control-label" for="input-first-name" style="float: left;">File đính kèm <sup class="title-sup">(*)</sup></label>
                                        <input type="file" id="input-first-name" name="rf_path" class="form-control">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('rf_path') }}</p></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    @csrf
                                    <!-- Trường input ẩn lưu thông tin của $calendar->type -->
                                    <input type="hidden" name="rf_type" value="{{ $calendar->type }}">
                                    <div>
                                        <button type="submit" class="btn btn-primary text-right" style="margin-top: 31px;"> Nộp file kết quả</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop
