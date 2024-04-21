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
        <div class="row mt--5">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="card card-upgrade">
                    <div class="card-header text-center border-bottom-0">
                        <h2 class="card-title">{{ isset($topic->topic)  ? $topic->topic->t_title : '' }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Thông tin đề tài</h3>
                                </div>
                                <div class="col-4 text-right">
                                    @if ($topic->studentTopics->count() < $topic->tc_registration_number)
                                    <a href="" class="btn btn-sm btn-primary topic-registration" uid="{{ $topic->id }}" url="{{ route('register.topic', $topic->id) }}">Đăng ký</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%">Niên khóa </td>
                                        <td>{{$topic->course->c_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Giáo viên hướng dẫn</td>
                                        <td>{{$topic->teacher->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Hội đồng </td>
                                        <td>{{$topic->council->co_title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng sinh viên tối đa đăng ký</td>
                                        <td>{{$topic->tc_registration_number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ngày bắt đầu nộp đề cương : </td>
                                        <td><b>{{$topic->tc_start_outline}}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>Ngày kết thúc nộp đề cương : </td>
                                        <td><b>{{$topic->tc_end_outline}}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>Ngày bắt đầu nộp báo cáo : </td>
                                        <td><b>{{$topic->tc_start_thesis_book}}</b> </td>
                                    </tr>
                                    <tr>
                                        <td>Ngày kết thúc nộp báo cáo : </td>
                                        <td><b>{{$topic->tc_end_thesis_book}}</b> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if (isset($topic->studentTopics) && $topic->studentTopics->count() > 0)
                        <div class="card-header border-0">
                            <h3 class="mb-0">Danh sách sinh viên đăng ký</h3>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <tbody>
                                    @foreach($topic->studentTopics as $topic)
                                        @foreach($topic->students as $key => $student)
                                            <tr>
                                                <td style="width: 30%">Sinh viên {{ $key + 1 }}</td>
                                                <td><b>{{$student->name}}</b></td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <div class="card-header border-0">
                            <h3 class="mb-0">Mô tả đề tài</h3>
                        </div>
                        <div class="col-md-12" style="margin-left: 10px">
                            {!! $topic->topic->t_content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop