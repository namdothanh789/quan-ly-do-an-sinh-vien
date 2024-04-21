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
                            <h3 class="mb-0" style="text-transform: uppercase;">ĐĂNG KÝ ĐỀ TÀI ĐỒ ÁN TỐT NGHIỆP</h3>
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
                                <th scope="col">Bộ môn</th>
                                <th scope="col">Mã sinh viên</th>
                                <th scope="col">Họ tên sinh viên</th>
                                <th scope="col">Giảng viên hướng dẫn</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!$topics->isEmpty())
                                @foreach($topics as $key => $topic)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a href="{{ route('topic.detail', $topic->id) }}">{{$topic->topic->t_title}}</a></td>
                                        <td>{{$topic->department->dp_name}}</td>
                                        <td>
                                            @if (isset($topic->studentTopics) && $topic->studentTopics->count() > 0)
                                                @foreach($topic->studentTopics as $studentTopic)
                                                    @foreach($studentTopic->students as $key => $student)
                                                        <span>{{$student->code}}</span> <br/>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($topic->studentTopics) && $topic->studentTopics->count() > 0)
                                                @foreach($topic->studentTopics as $studentTopic)
                                                    @foreach($studentTopic->students as $key => $student)
                                                        <span>{{$student->name}}</span> <br/>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{$topic->teacher->name}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop