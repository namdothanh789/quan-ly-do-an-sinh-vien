@extends('page.layouts.main')
@section('title', 'Thống kê điểm quá trình')
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
                            <h3 class="mb-0" style="text-transform: uppercase;">ĐIỂM QUÁ TRÌNH</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-4 col-sm-12 mb-2">
                          <div class="d-flex flex-column h-100 justify-content-between">
                              <div>Task Points: {{ $studentData['task_points'] }}</div>
                              <a href="{{ route('user.get.calendar', $studentData['studentTopicId']) }}" class="btn btn-primary btn-sm mt-1">View Task Details</a>
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-12 mb-2">
                          <div class="d-flex flex-column h-100 justify-content-between">
                              <div>Report Points: {{ $studentData['report_points'] }}</div>
                              <a href="{{ route('user.points.report_details', $studentData['studentTopicId']) }}" class="btn btn-primary btn-sm mt-1">View Report Details</a>
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-12 mb-2">
                          <div class="d-flex flex-column h-100 justify-content-between">
                              <div>Interaction Points: {{ $studentData['interaction_points'] }}</div>
                              <a href="{{ route('user.points.interaction_details', $studentData['studentTopicId']) }}" class="btn btn-primary btn-sm mt-1">View Interaction Details</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card-footer">
                  <h4 class="card-title">
                      Điểm quá trình: {{ $studentData['total_points'] }}
                      <i class="fas fa-info-circle" data-toggle="tooltip" title="Điểm quá trình (theo thang 10) = (tổng 3 loại điểm) * 10/9"></i>
                  </h4>
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
        <!-- Footer -->
        @include('page.common.footer')
    </div>
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