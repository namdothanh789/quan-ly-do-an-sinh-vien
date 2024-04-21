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
                            <h3 class="mb-0" style="text-transform: uppercase;">NỘP QUYỂN ĐỒ ÁN : {{ isset($studentTopic->topic) ? $studentTopic->topic->topic->t_title : '' }}</h3>
                        </div>
                        <div class="col text-right">
                            {{--<a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('user.post.thesis.book', $studentTopic->id) }}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username" style="float: left;">Tên quyển đồ án <sup class="title-sup">(*)</sup></label>
                                        <input type="text" id="input-username" class="form-control" name="st_thesis_book" value="{{ old('st_thesis_book') }}">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('st_thesis_book') }}</p></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name" style="float: left;">File đính kèm <sup class="title-sup">(*)</sup></label>
                                        <input type="file" id="input-first-name" name="thesis_book" class="form-control">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('thesis_book') }}</p></span>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            @if (isset($studentTopic->topic) && checkInTime($studentTopic->topic->tc_start_thesis_book, $studentTopic->topic->tc_end_thesis_book))
                                <div style="text-align: right">
                                    <button type="submit" class="btn btn-primary text-right"> Nộp báo cáo</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col" style="flex-basis: unset !important;">
                            <h3 class="mb-0" style="text-transform: uppercase;">Danh sách file báo cáo</h3>
                        </div>
                        <div class="col text-right">
                            {{--<a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsiver">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tiêu đề </th>
                                    <th scope="col">File</th>
                                    <th scope="col">File phản hồi</th>
                                    <th scope="col" style="width: 25%">Nhận sét</th>
                                    <th scope="col">Điểm</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày nộp</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!$result_files->isEmpty())
                                    @foreach($result_files as $key => $result)
                                        <tr>
                                            <td style="vertical-align: middle">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle">{{ $result->rf_title }}</td>
                                            <td style="vertical-align: middle">
                                                @if (!empty($result->rf_part_file))
                                                    <a href="{!! asset('uploads/documents/' . $result->rf_part_file) !!}" download>Dowload</a>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle">
                                                @if (!empty($result->rf_part_file_feedback))
                                                    <a href="{!! asset('uploads/documents/' . $result->rf_part_file_feedback) !!}" download>Dowload</a>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle; width: 25%">
                                                {!! $result->rf_comment !!}
                                            </td>
                                            <td style="vertical-align: middle">{{ $result->rf_point }}</td>
                                            <td style="vertical-align: middle">{{ isset($status_outline[$result->rf_status]) ? $status_outline[$result->rf_status] : '' }}</td>
                                            <td style="vertical-align: middle">{{ date('Y-m-d H:i', strtotime($result->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop