@extends('admin.layouts.main')
@section('title', 'Admin')
@section('style-css')
<!-- fullCalendar -->
<link rel="stylesheet" href="{!! asset('admin/plugins/fullcalendar/main.min.css') !!}">
<link rel="stylesheet" href="{!! asset('admin/plugins/fullcalendar-daygrid/main.min.css') !!}">
<link rel="stylesheet" href="{!! asset('admin/plugins/fullcalendar-timegrid/main.min.css') !!}">
<link rel="stylesheet" href="{!! asset('admin/plugins/fullcalendar-bootstrap/main.min.css') !!}">
@stop
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản lý đồ án</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý đồ án</a></li>
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
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Thống kê dữ liệu</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $numTeacher }}</h3>

                                <p>Tổng số giáo viên</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fa fa-fw fa-user"></i>
                            </div>
                            @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-giao-vien']))
                            <a href="{{ route('user.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                            @else
                            <a href="#" class="small-box-footer"></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $numStudent }}</h3>

                                <p>Tổng số sinh viên</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fa fa-graduation-cap"></i>
                            </div>
                            @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-sinh-vien']))
                            <a href="{{ route('student.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                            @else
                            <a href="#" class="small-box-footer"> </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box btn-primary">
                            <div class="inner">
                                <h3>{{ $numTopic }}</h3>

                                <p>Tổng số đề tài</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-file-word"></i>
                            </div>
                            @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-de-tai']))
                            <a href="{{ route('topic.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                            @else
                            <a href="#" class="small-box-footer"> Dữ liệu</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box btn-default">
                            <div class="inner">
                                <h3>{{ $numDepartment }}</h3>

                                <p>Tổng số khoa / bộ môn</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fa fa-fw fa-sitemap"></i>
                            </div>
                            @if ($user->can(['toan-quyen-quan-ly', 'quan-ly-danh-sach-khoa-bo-mon',]))
                            <a href="{{ route('department.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                            @else
                            <a href="#" class="small-box-footer"> Dữ liệu</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@stop
@section('script')
    <script src="{!! asset('admin/plugins/jquery-ui/jquery-ui.min.js') !!}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{!! asset('admin/plugins/moment/moment.min.js') !!}"></script>
    <script src="{!! asset('admin/plugins/fullcalendar/main.min.js') !!}"></script>
    <script src="{!! asset('admin/plugins/fullcalendar-daygrid/main.min.js') !!}"></script>
    <script src="{!! asset('admin/plugins/fullcalendar-timegrid/main.min.js') !!}"></script>
    <script src="{!! asset('admin/plugins/fullcalendar-interaction/main.min.js') !!}"></script>
    <script src="{!! asset('admin/plugins/fullcalendar-bootstrap/main.min.js') !!}"></script>
    <script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
    <script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            //ini_events($('#external-events div.external-event'))
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendarInteraction.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
                    {{--// -------------------------------------------------------------------}}


            var calendar = new Calendar(calendarEl, {
                    plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                    header    : {
                        left  : 'prev,next',
                        center: 'title',
                        right  : 'prev,next',
                    },
                    views: {
                        dayGridMonth: { // name of view
                            titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit' }
                            // other view-specific options here
                        }
                    },
                    eventDidMount: function(info) {
                        var tooltip = new Tooltip(info.el, {
                            title: info.event.extendedProps.description,
                            placement: 'top',
                            trigger: 'hover',
                            container: 'body'
                        });
                    },
                    'themeSystem': 'bootstrap',
                    //Random default events

                    events    : [
                            @foreach ($notifications as $key => $notification)
                        {
                            title          : '{{ $notification->n_title }}',
                            start          : new Date(parseInt('{{ \Carbon\Carbon::parse($notification->n_from_date)->format('Y') }}'), parseInt('{{ \Carbon\Carbon::parse($notification->n_from_date)->format('m') - 1 }}'), parseInt('{{ \Carbon\Carbon::parse($notification->n_from_date)->format('d') }}'), parseInt('{{ \Carbon\Carbon::parse($notification->n_from_date)->format('H') }}'), parseInt('{{ \Carbon\Carbon::parse($notification->n_from_date)->format('i') }}')),
                            end            : new Date(parseInt('{{ \Carbon\Carbon::parse($notification->n_end_date)->format('Y') }}'), parseInt('{{ \Carbon\Carbon::parse($notification->n_end_date)->format('m') - 1 }}'), parseInt('{{ \Carbon\Carbon::parse($notification->n_end_date)->format('d') }}'), parseInt('{{ \Carbon\Carbon::parse($notification->n_end_date)->format('H') }}'), parseInt('{{ \Carbon\Carbon::parse($notification->n_end_date)->format('i') }}')),
                            backgroundColor: '{{ $notification->n_schedule_type }}',
                            borderColor    : '{{ $notification->n_schedule_type }}',
                            allDay         : false,
                            url            : '{{ route('schedule.student.show', $notification->id) }}',
                            description    : 'Có lịch hẹn với : @if (isset($notification->notificationUsers)) @foreach($notification->notificationUsers as $item) {{ $item->user->name }} @endforeach @endif',
                        },
                        @endforeach
                    ],
                    editable  : true,
                    droppable : true, // this allows things to be dropped onto the calendar !!!
                    drop      : function(info) {
                        // is the "remove after drop" checkbox checked?
                        if (checkbox.checked) {
                            // if so, remove the element from the "Draggable Events" list
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    }
                });
            calendar.render();
        })
    </script>
@stop