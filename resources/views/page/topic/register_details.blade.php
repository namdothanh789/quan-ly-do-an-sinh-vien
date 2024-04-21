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
                    @if (isset($studentTopic->topic) && checkInTime($studentTopic->topic->tc_start_time, $studentTopic->topic->tc_end_time))
                    <div class="col text-right">
                        <a href="{{ route('user.cancel.registration', $studentTopic->id) }}" class="btn btn-sm btn-danger">Hủy Đăng Ký</a>
                    </div>
                    @endif
                </div>
                <br />
                <div class="row">
                    <div class="col-6" style="flex-basis: unset !important;">
                        @if (in_array($studentTopic->st_status, [1,2]))
                        <h3 class="mb-0" style="text-transform: uppercase;">KẾT QUẢ ĐÁNH GIÁ </h3>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <tbody>
                                <tr>
                                    <td>Trạng thái :</td>
                                    <td>
                                        <span class="btn btn-sm @if ($studentTopic->st_status)btn-success @else btn-danger @endif">
                                            {{ isset($status[$studentTopic->st_status]) ? $status[$studentTopic->st_status] : '' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Điểm bảo vệ : </td>
                                    <td>
                                        <b>{{ $studentTopic->st_point }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Điểm trung bình : </td>
                                    <td>
                                        <b>{{ round(($studentTopic->st_point + $studentTopic->st_point_thesis_book + $studentTopic->st_point_outline)/3, 2) }}</b>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12 topic-description" style="word-break: break-all;">
                                {!! $studentTopic->st_comments !!}
                            </div>
                        </div>
                        @endif
                        <h3 class="mb-0" style="text-transform: uppercase;">THÔNG TIN ĐỀ TÀI ĐÃ ĐĂNG KÝ</h3>

                        <div class="table-responsive">
                            <!-- Projects table -->
                            @if (isset($studentTopic->topic))
                            <table class="table align-items-center table-flush">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%">Tên đề tài : </td>
                                        <td>{{ isset($studentTopic->topic) ? $studentTopic->topic->topic->t_title : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%">Giáo viên hướng dẫn : </td>
                                        <td>{{ isset($studentTopic->teacher) ? $studentTopic->teacher->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng sinh viên :</td>
                                        <td>{{ isset($studentTopic->topic) ? $studentTopic->topic->tc_registration_number : 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng sinh viên đăng ký :</td>
                                        <td>{{ $numberStudent }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bộ môn :</td>
                                        <td>{{ isset($studentTopic->topic) ?  $studentTopic->topic->department->dp_name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nội dung công việc :</td>
                                        <td><a href="{{ route('user.get.calendar', $studentTopic->id) }}">Nội dung công việc cần hoàn thành</a></td>
                                    </tr>
                                    <tr>
                                        <td>Trạng thái :</td>
                                        <td>
                                            @if ($studentTopic->topic->tc_registration_number == $numberStudent)
                                            <div class="badge badge-danger">Đã đủ SV</div>
                                            @else
                                            <span class="badge badge-success">Còn {{ $studentTopic->topic->tc_registration_number - $numberStudent  }}</span>
                                            @endif

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12 topic-description" style="word-break: break-all;">
                                {!! $studentTopic->topic->topic->t_content !!}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-6" style="flex-basis: unset !important;">
                        @if ($studentTopic->st_status_outline)
                        <h3 class="mb-0" style="text-transform: uppercase;">THÔNG TIN ĐỀ CƯƠNG </h3>
                        <div class="table-responsive ta">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <tbody>
                                    {{--<tr>--}}
                                        {{--<td style="width: 30%">Tên đề cương : </td>--}}
                                        {{--<td>{{ isset($studentTopic->st_outline) ? $studentTopic->st_outline : '' }}</td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td style="width: 30%">Danh sách file : </td>
                                        <td>
                                            @if ($studentTopic->result_outline_files->count() > 0)
                                            <a href="{{ route('user.outline') }}" target="_blank">Danh sách</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%">Trạng thái : </td>
                                        <td>{{ isset($status_outline[$studentTopic->st_status_outline]) ? $status_outline[$studentTopic->st_status_outline] : 'Chưa nộp' }}</td>
                                    </tr>
                                    @if ($studentTopic->st_point_outline)
                                    <tr>
                                        <td style="width: 30%">Điểm : </td>
                                        <td>{{ $studentTopic->st_point_outline }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if (!empty($studentTopic->st_comment_outline))
                                <div class="col-md-12 topic-description" style="word-break: break-all;">
                                   {!! $studentTopic->st_comment_outline !!}
                                </div>
                            @endif
                        </div>
                        @endif
                        @if ($studentTopic->st_status_thesis_book)
                        <h3 class="mb-0" style="text-transform: uppercase;">THÔNG TIN QUYỂN ĐỒ ÁN</h3>

                        <div>
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <tbody>
                                    {{--<tr>--}}
                                        {{--<td style="width: 30%">Tên báo cáo : </td>--}}
                                        {{--<td>{{ isset($studentTopic->st_thesis_book) ? $studentTopic->st_thesis_book : '' }}</td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td style="width: 30%">Danh sách file : </td>
                                        <td>
                                            @if ($studentTopic->result_book_files->count() > 0)
                                            <a href="{{ route('user.thesis.book') }}" target="_blank">Danh sách file</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($studentTopic->st_point_thesis_book)
                                    <tr>
                                        <td style="width: 30%">Điểm : </td>
                                        <td>{{ $studentTopic->st_point_thesis_book }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td style="width: 30%">Trạng thái : </td>
                                        <td>{{ isset($status_outline[$studentTopic->st_status_thesis_book]) ? $status_outline[$studentTopic->st_status_thesis_book] : 'Chưa nộp' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if (!empty($studentTopic->st_comment_thesis_book))
                                <div class="col-md-12 topic-description" style="word-break: break-all;">
                                    {!! $studentTopic->st_comment_thesis_book !!}
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>
    <!-- Footer -->
    @include('page.common.footer')
</div>
@stop