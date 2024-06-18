@extends('page.layouts.main')
@section('title')
@section('style')
    <script src="{!! asset('admin/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('admin/ckfinder/ckfinder.js') !!}"></script>
    <script src="{!! asset('admin/dist/js/func_ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/')!!}"
    </script>
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
                            <h3 class="mb-0" style="text-transform: uppercase;">TẠO MỚI LỊCH HẸN </h3>
                        </div>

                        <div class="col-4 text-right">
                            <a href="{{ route('user.schedule.teacher') }}" class="btn btn-sm btn-primary">Danh sách</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="container-fluid">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card card-primary">
                                        <!-- form start -->
                                        <div class="card-body">
                                            <div class="form-group {{ $errors->first('n_title') ? 'has-error' : '' }} ">
                                                <label for="inputEmail3" class="control-label default">Tiêu đề <sup class="text-danger">(*)</sup></label>
                                                <div>
                                                    <input type="text" maxlength="100" class="form-control"  placeholder="Tiêu đề" name="n_title" value="{{ old('n_title') }}">
                                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_title') }}</p></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group {{ $errors->first('teacher_id') ? 'has-error' : '' }} col-md-6">
                                                    <label for="teacher_id" class="col-form-label default">Giáo viên hướng dẫn: {{ $teacher->name }}</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="teacher_id" value="{{ $teacher->id }}" readonly hidden>
                                                        <span class="text-danger">
                                                            <p class="mg-t-5">{{ $errors->first('teacher_id') }}</p>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group {{ $errors->first('n_schedule_type') ? 'has-error' : '' }} col-md-6" >
                                                    <label for="inputName2" class="col-form-label default">Loại cuộc hẹn <sup class="text-danger">(*)</sup></label>
                                                    <div>
                                                        <select name="n_schedule_type" class="form-control" id="scheduleType">
                                                            @foreach($schedule_types as $key => $type)
                                                                <option  {{old('n_schedule_type') == $key ? 'selected' : '' }}  value="{{$key}}">{{$type}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('n_schedule_type') }}</p></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6" {{ $errors->first('users') ? 'has-error' : '' }} id="userSelectContainer" style="display: none;">
                                                    <label for="users" class="col-form-label default">Chọn sinh viên tham gia</label>
                                                        <div>
                                                            <select name="users[]" class="form-control select2" multiple="multiple" id="users">
                                                                @foreach($sameTopicStudentList as $student)
                                                                    <option value="{{ $student->id }}" {{ in_array($student->id, old('users', [])) ? 'selected' : '' }}>{{ $student->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger">
                                                                <p class="mg-t-5">{{ $errors->first('users') }}</p>
                                                            </span>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group {{ $errors->first('meeting_type') ? 'has-error' : '' }} col-md-6">
                                                    <label for="meeting_type">Offline/Online? <sup class="text-danger">(*)</sup></label>
                                                        <select id="meeting_type" name="meeting_type" class="form-control">
                                                            <option {{ old('meeting_type') == 'offline' ? 'selected' : '' }} value="offline">Offline</option>
                                                            <option {{ old('meeting_type') == 'online' ? 'selected' : '' }} value="online">Online</option>
                                                        </select>
                                                        <span class="text-danger">
                                                            <p class="mg-t-5">{{ $errors->first('meeting_type') }}</p>
                                                        </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group {{ $errors->first('location') ? 'has-error' : '' }} col-md-6" id="location_group">
                                                    <label for="location">Địa điểm <sup class="text-danger">(*)</sup></label>
                                                    <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}">
                                                    <span class="text-danger">
                                                        <p class="mg-t-5">{{ $errors->first('location') }}</p>
                                                    </span>
                                                    <div id="location_suggestions" class="list-group"></div>
                                                </div>
                                                <div class="form-group {{ $errors->first('location_details') ? 'has-error' : '' }} col-md-6" id="location_details_group">
                                                    <label for="location_details">Địa điểm chi tiết <sup class="text-danger">(*)</sup></label>
                                                    <input type="text" id="location_details" name="location_details" class="form-control" value="{{ old('location_details') }}">
                                                    <span class="text-danger">
                                                        <p class="mg-t-5">{{ $errors->first('location_details') }}</p>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group {{ $errors->first('n_from_date') ? 'has-error' : '' }} col-md-6" >
                                                    <label for="inputName2" class="col-form-label">Thời gian bắt đầu <sup class="text-danger">(*)</sup></label>
                                                    <div>
                                                        <input type="datetime-local" name="n_from_date" class="form-control" value="{{ old('n_from_date') }}">
                                                    </div>
                                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_from_date') }}</p></span>
                                                </div>
                    
                                                <div class="form-group {{ $errors->first('n_end_date') ? 'has-error' : '' }} col-md-6" >
                                                    <label for="inputName2" class="col-form-label">Thời gian kết thúc <sup class="text-danger">(*)</sup></label>
                                                    <div>
                                                        <input type="datetime-local" name="n_end_date" class="form-control" value="{{ old('n_end_date') }}">
                                                    </div>
                                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('n_end_date') }}</p></span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->first('n_content') ? 'has-error' : '' }}">
                                                <label for="inputEmail3" class="control-label default">Nội dung <sup class="text-danger">(*)</sup></label>
                                                <div>
                                                    <textarea name="n_content" id="n_content" style="resize:vertical" class="form-control" placeholder="Mô tả chức vụ ...">{{ old('n_content') }}</textarea>
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
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop
@push('scripts')
<script>
    $(document).ready(function() {
        //Student attendees logic
        $('.select2').select2();

        function toggleUserSelect() {
            var scheduleType = $('#scheduleType').val();
            if (scheduleType === 'red') {
                $('#userSelectContainer').show();
            } else {
                $('#userSelectContainer').hide();
            }
        }

        $('#scheduleType').change(toggleUserSelect);
        toggleUserSelect(); // Initial check

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
