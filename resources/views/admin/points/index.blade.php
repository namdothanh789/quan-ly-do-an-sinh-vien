@extends('admin.layouts.main')
@section('title', 'Thống kê điểm')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{ route('student.topics.index') }}">Danh sách đề tài</a></li> --}}
                    <li class="breadcrumb-item active">Thống kê điểm</li>
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
          <div class="col-md-4">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">{{ $studentData['student']->name }}</h3>
                  </div>
                  <div class="card-body">
                      <p>Task Points: {{ $studentData['task_points'] }}</p>
                      <a href="{{ route('calendar.index', $studentData['studentTopicId']) }}" class="btn btn-primary">View Task Details</a>
                      
                      <p>Report Points: {{ $studentData['report_points'] }}</p>
                      <a href="{{ route('admin.points.report_details', $studentData['studentTopicId']) }}" class="btn btn-primary">View Report Details</a>
                      
                      <p>Interaction Points: {{ $studentData['interaction_points'] }}</p>
                      <a href="{{ route('admin.points.interaction_details', $studentData['studentTopicId']) }}" class="btn btn-primary">View Interaction Details</a>
                  </div>
                  <div class="card-footer">
                    <h4 class="card-title">
                        Total Points: {{ $studentData['total_points'] }}
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
                      <h3 class="card-title">Points Pie Chart</h3>
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