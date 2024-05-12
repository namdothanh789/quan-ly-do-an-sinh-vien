@extends('page.layouts.main')
@section('title')
@section('style')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/fullcalendar/main.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/plugins/fullcalendar-daygrid/main.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/plugins/fullcalendar-timegrid/main.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/plugins/fullcalendar-bootstrap/main.min.css') !!}">
@stop
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
            <div class="col-xl-12" style="margin: auto">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8" style="flex-basis: unset !important;">
                            <h3 class="mb-0" style="text-transform: uppercase;">LỊCH HẸN</h3>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('schedule.teacher.create') }}" class="btn btn-sm btn-primary">Tạo mới</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 50px">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop
@section('script')
    <script src="{!! asset('admin/plugins/jquery/jquery.min.js') !!}"></script>
    <!-- Bootstrap 4 -->
    <script src="{!! asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <!-- overlayScrollbars -->
    <script src="{!! asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
    <!-- AdminLTE App -->
    <script src="{!! asset('admin/dist/js/adminlte.min.js') !!}"></script>

    <script src="{!! asset('admin/plugins/jquery-confirm/dist/jquery-confirm.min.js') !!}"></script>
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
                            url            : '{{ route('user.schedule.calendar.show', $notification->id) }}',
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