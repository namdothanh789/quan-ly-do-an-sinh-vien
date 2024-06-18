@extends('admin.layouts.main')
@section('title', 'Chỉnh sửa lịch hẹn')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('schedule.student.index') }}">Lịch hẹn</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-primary">
                            <!-- form start -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group {{ $errors->first('n_title') ? 'has-error' : '' }} col-md-6">
                                        <label for="inputEmail3" class="col-form-label">Tiêu đề <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <input type="text" maxlength="100" class="form-control"  placeholder="Tiêu đề lịch hẹn" name="n_title" value="{{ $notification->n_title }}">
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_title') }}</p></span>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('topic_id') ? 'has-error' : '' }} col-md-6" >
                                        <label for="inputName2" class="col-form-label">Chọn đề tài <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <select name="topic_id" class="form-control topic-select">
                                                <option value="">Select</option>
                                                @foreach($topics as $topic)
                                                    <option value="{{$topic->id}}">{{$topic->t_title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('topic_id') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group {{ $errors->first('n_schedule_type') ? 'has-error' : '' }} col-md-6" >
                                        <label for="inputName2" class="col-form-label">Loại cuộc hẹn </label>
                                        <div>
                                            <select name="n_schedule_type" class="form-control">
                                                @foreach($schedule_types as $key => $type)
                                                    <option  {{old('n_schedule_type') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_schedule_type') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group {{ $errors->first('users') ? 'has-error' : '' }} col-md-6">
                                        <label for="inputEmail3" class="control-label default">Danh sách tham gia <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <select class="custom-select  select2 student-list" id="users" name="users[]" multiple>
                                                <option value="">Chọn người tham gia</option>
                                                @foreach ($notifiedStudentList as $student)
                                                    <option value="{{ $student->id }}" selected>{{ $student->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('users') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group {{ $errors->first('meeting_type') ? 'has-error' : '' }} col-md-6">
                                        <label for="meeting_type">Offline/Online? <sup class="text-danger">(*)</sup></label>
                                            <select id="meeting_type" name="meeting_type" class="form-control">
                                                <option {{ $notification->meeting_type == 'offline' ? 'selected' : '' }} value="offline">Offline</option>
                                                <option {{ $notification->meeting_type == 'online' ? 'selected' : '' }} value="online">Online</option>
                                            </select>
                                            <span class="text-danger">
                                                <p class="mg-t-5">{{ $errors->first('meeting_type') }}</p>
                                            </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group {{ $errors->first('location') ? 'has-error' : '' }} col-md-6" id="location_group">
                                        <label for="location">Địa điểm <sup class="text-danger">(*)</sup></label>
                                        <input type="text" id="location" name="location" class="form-control" value="{{ $notification->location }}">
                                        <span class="text-danger">
                                            <p class="mg-t-5">{{ $errors->first('location') }}</p>
                                        </span>
                                        <div id="location_suggestions" class="list-group"></div>
                                    </div>
                                    <div class="form-group {{ $errors->first('location_details') ? 'has-error' : '' }} col-md-6" id="location_details_group">
                                        <label for="location_details">Địa điểm chi tiết <sup class="text-danger">(*)</sup></label>
                                        <input type="text" id="location_details" name="location_details" class="form-control" value="{{ $notification->location_details }}">
                                        <span class="text-danger">
                                            <p class="mg-t-5">{{ $errors->first('location_details') }}</p>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group {{ $errors->first('n_from_date') ? 'has-error' : '' }} col-md-6">
                                        <label for="inputName2" class="col-form-label">Thời gian bắt đầu <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <input type="datetime-local" name="n_from_date" class="form-control" value="{{ $notification->n_from_date }}">
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_from_date') }}</p></span>
                                        </div>
                                    </div>
        
                                    <div class="form-group {{ $errors->first('n_from_date') ? 'has-error' : '' }} col-md-6">
                                        <label for="inputName2" class="col-form-label">Thời gian kết thúc <sup class="text-danger">(*)</sup></label>
                                        <div>
                                            <input type="datetime-local" name="n_end_date" class="form-control" value="{{ $notification->n_end_date }}">
                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_end_date') }}</p></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('n_content') ? 'has-error' : '' }}">
                                    <label for="inputEmail3" class="control-label default">Nội dung thông báo <sup class="text-danger">(*)</sup></label>
                                    <div>
                                        <textarea name="n_content" id="n_content" style="resize:vertical" class="form-control" placeholder="Mô tả chức vụ ...">{{ $notification->n_content }}</textarea>
                                        <script>
                                            ckeditor(n_content);
                                        </script>
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_content') }}</p></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Xuất bản</h3>
                            </div>
                            <div class="card-body">
                                <div class="btn-set">
                                    <button type="submit" name="submit" class="btn btn-info">
                                        <i class="fa fa-save"></i> Lưu dữ liệu
                                    </button>
                                    <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.topic-select', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('schedule.student.list') }}",
                    data: {
                        id: id
                    },
                    success: function(data){
                        $('.student-list').html('<option value="">Chọn người tham gia</option>')

                        $.each(data, function(i, item){
                            $('.student-list').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })

            //Location logic
            function toggleLocationFields() {
                if ($('#meeting_type').val() === 'online') {
                    console.log('change1');
                    $('#location_group').hide();
                    $('#location_details_group').hide();
                } else {
                    $('#location_group').show();
                    $('#location_details_group').show();
                }
            }

            // Initial call to set the correct visibility based on the default value
            toggleLocationFields();

            // Add event listener to meeting_type select
            $('#meeting_type').change(function() {
                console.log('change');
                toggleLocationFields();
            });

            // Function to call OpenCage Geocoding API
            function fetchLocationSuggestions(query) {
                var apiKey = '{{ env('OPENCAGE_API_KEY') }}';
                $.ajax({
                    url: 'https://api.opencagedata.com/geocode/v1/json',
                    data: {
                        key: apiKey,
                        q: query,
                        limit: 5
                    },
                    success: function(data) {
                        var suggestions = '';
                        if (data.results && data.results.length > 0) {
                            data.results.forEach(function(result) {
                                suggestions += '<a href="#" class="list-group-item list-group-item-action">' + result.formatted + '</a>';
                            });
                        }
                        $('#location_suggestions').html(suggestions);
                    }
                });
            }

            // Event listener for location input
            $('#location').on('input', function() {
                var query = $(this).val();
                if (query.length > 2) { // Fetch suggestions if query length is greater than 2
                    fetchLocationSuggestions(query);
                } else {
                    $('#location_suggestions').empty();
                }
            });

            // Event listener for suggestion click
            $(document).on('click', '#location_suggestions .list-group-item', function(e) {
                e.preventDefault();
                var selectedLocation = $(this).text();
                $('#location').val(selectedLocation);
                $('#location_suggestions').empty();
            });
            });
    </script>
@endpush