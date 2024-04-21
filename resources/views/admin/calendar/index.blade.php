@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('calendar.index', $student_topic_id) }}">Phân công công việc</a></li>
                        <li class="breadcrumb-item active">Đề tài : {{ $topic->topic->topic->t_title }} Sinh viên : {{ $topic->student->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @php
        $user = Auth::user();
    @endphp
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group">
                                    @if ($user->can(['toan-quyen-quan-ly', 'them-moi-phan-cong-cong-viec']))
                                    <a href="{{ route('calendar.create', $student_topic_id) }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Thời gian</th>
                                        <th>Nội dung</th>
                                        <th>Kết quả</th>
                                        <th>Trạng thái</th>
                                        @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-phan-cong-cong-viec', 'xoa-phan-cong-cong-viec']))
                                        <th>Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$calendars->isEmpty())
                                        @php $i = $calendars->firstItem(); @endphp
                                        @foreach($calendars as $calendar)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                                <td style="vertical-align: middle">{{$calendar->title}}</td>
                                                <td style="vertical-align: middle">
                                                    <p>{{ $calendar->start_date .' đến '.$calendar->end_date }}</p>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <a href="" class="work-content" calendar="{{ $calendar->id }}">Nội dung công việc</a>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    @if (!empty($calendar->file_result) && !empty($calendar->file_result))
                                                        <a href="{!! asset('uploads/calendar/' . $calendar->file_result) !!}" target="_blank" download>Dowload</a>
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <button type="button" class="btn btn-block {{ $classStatus[$calendar->status] }} btn-xs">{{ $status[$calendar->status] }}</button>
                                                </td>
                                                @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-phan-cong-cong-viec', 'xoa-phan-cong-cong-viec']))
                                                <td class="text-center" style="vertical-align: middle">
                                                    @if ($user->can(['toan-quyen-quan-ly', 'chinh-sua-phan-cong-cong-viec']))
                                                    <a class="btn btn-primary btn-sm" href="{{ route('calendar.update', $calendar->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @endif
                                                        @if ($user->can(['toan-quyen-quan-ly', 'xoa-phan-cong-cong-viec']))
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('calendar.delete', $calendar->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                                @endif
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($calendars->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $calendars->appends($query = '')->links() }}
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop

<div class="modal modal-work-content fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row" style="margin: auto;">
                    <div class="col-md-12 text-center">
                        <h4 class="modal-title" style="text-transform: uppercase; font-weight: bold; ">Nội dung công việc</h4>
                    </div>
                </div>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.mod -->
</div>

@section('script')
    <script>
        $(function () {
            var url = "{{ route('calendar.show') }}";
            $('.work-content').click(function (event) {

                event.preventDefault();

                let calendar = $(this).attr('calendar');

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    format: "json",
                    async: true,
                    data : {
                        id : calendar
                    }

                }).done(function(result) {

                    if (result.code == 200) {
                        $('.modal-body').html(result.data.contents);
                        $(".modal-work-content").modal('show');
                    }

                });

                console.log(calendar)
            })
        })
    </script>
@stop
