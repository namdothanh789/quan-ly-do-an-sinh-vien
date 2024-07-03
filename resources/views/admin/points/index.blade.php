@extends('admin.layouts.main')
@section('title', 'Thống kê điểm quá trình')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{ route('student.topics.index') }}">Danh sách đề tài</a></li> --}}
                    <li class="breadcrumb-item active"> <i class="nav-icon fas fa fa-star"></i> Điểm quá trình</li>
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
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">{{ $studentData['student']->name }}</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="d-flex flex-column h-100 justify-content-between">
                                <div>Task Points: {{ $studentData['task_points'] }}</div>
                                <a href="{{ route('calendar.index', $studentData['studentTopicId']) }}" class="btn btn-primary btn-sm mt-1">View Task Details</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="d-flex flex-column h-100 justify-content-between">
                                <div>Report Points: {{ $studentData['report_points'] }}</div>
                                <a href="{{ route('admin.points.report_details', $studentData['studentTopicId']) }}" class="btn btn-primary btn-sm mt-1">View Report Details</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="d-flex flex-column h-100 justify-content-between">
                                <div>Interaction Points: {{ $studentData['interaction_points'] }}</div>
                                <a href="{{ route('admin.points.interaction_details', $studentData['studentTopicId']) }}" class="btn btn-primary btn-sm mt-1">View Interaction Details</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <h4 class="card-title">
                        Điểm quá trình: {{ $studentData['total_points'] }}
                        <i class="fa fa-info-circle" data-toggle="tooltip" title="Điểm quá trình (theo thang 10) = (tổng 3 loại điểm) * 10/9"></i>
                    </h4>
                  </div>
              </div>
          </div>
      </div>
    
      <div class="row justify-content-center">
          <div class="col-md-3">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Pie Chart: Các điểm thành phần</h3>
                  </div>
                  <div class="card-body">
                      <canvas id="pointsPieChart"></canvas>
                  </div>
              </div>
          </div>
      </div>
    </div>
</section>
@stop
@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    var ctx = document.getElementById('pointsPieChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Task Points', 'Report Points', 'Interaction Points'],
            datasets: [{
                label: 'Points Distribution',
                data: [
                  {{ $studentData['task_points'] }},
                  {{ $studentData['report_points'] }},
                  {{ $studentData['interaction_points'] }},
                ],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }]
        },
        options: {}
    });
  </script>
@endpush