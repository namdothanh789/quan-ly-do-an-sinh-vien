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
                            <h3 class="mb-0" style="text-transform: uppercase;">NỘP QUYỂN ĐỒ ÁN : </h3>
                        </div>
                        <div class="col text-right">
                            {{--<a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('file.result', $calendar->id) }}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name" style="float: left;">File đính kèm <sup class="title-sup">(*)</sup></label>
                                        <input type="file" id="input-first-name" name="file_result" class="form-control">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('file_result') }}</p></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    @csrf
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