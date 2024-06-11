@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item">Dánh sách file {{ $type == 1 ? 'đề cương' : 'báo cáo'}}</li>
                        <li class="breadcrumb-item active">Đề tài : {{ isset($student->topic) ? $student->topic->topic->t_title : '' }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tiêu đề </th>
                                    <th scope="col">File</th>
                                    <th scope="col">File phản hồi</th>
                                    <th scope="col" style="width: 25%">Nhận xét</th>
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop
