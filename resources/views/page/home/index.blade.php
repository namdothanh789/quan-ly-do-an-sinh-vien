@extends('page.layouts.main')
@section('title', 'Trang chủ')
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
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    @if (!empty($course->c_start_time) && !empty($course->c_end_time) && checkInTime($course->c_start_time, $course->c_end_time))
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col" style="flex-basis: unset !important;">
                                <h3 class="mb-0" style="text-transform: uppercase;">ĐĂNG KÝ ĐỒ ÁN TỐT NGHỆP CHO SINH VIÊN KHOA {{ isset($department->parent) ? $department->parent->dp_name : '' }} Bộ Môn {{ $department->dp_name }}  Niên khóa {{ $course->c_name }}</h3>
                            </div>
                            <div class="col text-right">
                                {{--<a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col=md-12">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên đề tài </th>
                                    <th scope="col">Niên khóa</th>
                                    <th scope="col">Giáo viên hướng dẫn</th>
                                    <th scope="col">Hội đồng</th>
                                    <th scope="col">Khoa / Bộ môn</th>
                                    <th class="text-center">Đăng ký</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!$topics->isEmpty())
                                    @foreach($topics as $key => $topic)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><a href="{{ route('topic.detail', $topic->id) }}">{{$topic->topic->t_title}}</a></td>
                                            <td>{{$topic->course->c_name}}</td>
                                            <td>{{$topic->teacher->name}}</td>
                                            <td><a href="">{{$topic->council->co_title}}</a></td>
                                            <td>{{$topic->department->dp_name}}</td>
                                            <td class="text-center">
                                                @if ($topic->studentTopics->count() < $topic->tc_registration_number)
                                                <a href="" class="topic-registration" uid="{{ $topic->id }}" url="{{ route('register.topic', $topic->id) }}">Đăng ký</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col" style="flex-basis: unset !important;">
                                    <h3 class="mb-0" style="text-transform: uppercase; color: red">Chú ý: Chưa đến thời gian đăng kí đồ án tốt nghiệp. Xin vui lòng quay lại sau!</h3>
                                </div>
                                <div class="col text-right">
                                    {{--<a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop