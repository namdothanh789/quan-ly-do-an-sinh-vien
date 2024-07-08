@extends('admin.layouts.main')
@section('title', 'Danh sách file đồ án')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{ route('student.topics.index') }}">Danh sách đề tài</a></li> --}}
                    <li class="breadcrumb-item active">Danh sách file đồ án</li>
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
            <div class="card-header card-header-border-bottom">
                <h3 class="card-title">Form tìm kiếm</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="">
                    <div class="row">
                      <div class="col-sm-12 col-md-2">
                          <div class="form-group">
                            <input type="text" name="fileName" class="form-control mg-r-15" placeholder="Tên file">
                          </div>
                      </div>
                      <div class="col-sm-12 col-md-3">
                          <div class="form-group">
                              <input type="text" name="name" class="form-control mg-r-15" placeholder="Tên sinh viên">
                          </div>
                      </div>
                      <div class="col-sm-12 col-md-2">
                          <div class="form-group">
                              <select name="tc_course_id" class="form-control">
                                  <option value="">Chọn niên khóa</option>
                                  @foreach($courses as $key => $course)
                                  <option value="{{$course->id}}">{{$course->c_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-12 col-md-2">
                          <div class="input-group-append">
                              <button type="submit" name="search" value="true" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Search</button>
                          </div>
                      </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="btn-group">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="4%" class=" text-center">STT</th>
                                    <th>File đồ án (link)</th>
                                    <th>Sinh viên</th>
                                    <th>Đề tài</th>
                                    <th>Niên khóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$studentTopics->isEmpty())
                                @php $i = $studentTopics->firstItem(); @endphp
                                @foreach($studentTopics as $studentTopic)
                                <tr>
                                    <td style="vertical-align: middle" class=" text-center">{{ $i }}</td>
                                    <td style="vertical-align: middle">
                                      @foreach($studentTopic->calendars as $calendar)
                                          @if (!empty($calendar->resultFile) && !empty($calendar->resultFile->rf_path))
                                              <a href="{{ route('calendar.file.result.download', ['id' => $calendar->resultFile->id]) }}" target="_blank" download>{{ $calendar->resultFile->rf_title }}</a><br>
                                          @endif
                                      @endforeach
                                    </td>
                                    <td style="vertical-align: middle">{{ isset($studentTopic->student) ? $studentTopic->student->name : '' }}</td>
                                    <td style="vertical-align: middle" class="topic-title">{{ isset($studentTopic->topic) ? $studentTopic->topic->topic->t_title : '' }}</td>
                                    <td style="vertical-align: middle">{{ isset($studentTopic->course) ? $studentTopic->course->c_name : '' }}</td>
                                </tr>
                                @php $i++ @endphp
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