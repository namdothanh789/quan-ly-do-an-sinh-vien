@extends('page.layouts.main')
@section('title', 'Thống kê điểm tương tác')
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
                            <h3 class="mb-0" style="text-transform: uppercase;">THỐNG KÊ ĐIỂM TƯƠNG TÁC</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">Danh sách lịch hẹn được gửi cho sinh viên</h3>
                          </div>
                          <div class="card-body table-responsive p-0">
                              <table class="table table-hover text-nowrap table-bordered">
                                  <thead>
                                      <tr>
                                          <th width="5%" class=" text-center">STT</th>
                                          <th style="width: 30%;">Tên lịch hẹn</th>
                                          <th style="width: 15%;">Người tạo</th>
                                          <th style="width: 20%;">Đối tượng hẹn</th>
                                          <th style="width: 10%;">Bắt đầu</th>
                                          <th style="width: 10%;">Kết thúc</th>
                                          <th style="width: 10%;">Trạng thái tham gia của SV</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if (!$sentToStudentNotifications->isEmpty())
                                          @php $i = $sentToStudentNotifications->firstItem(); @endphp
                                          @foreach($sentToStudentNotifications as $sentToStudentNotification)
                                              <tr>
                                                  <td class=" text-center" style="vertical-align: middle; width: 5%;">{{ $i }}</td>
                                                  <td style="vertical-align: middle; width: 30%;">{{$sentToStudentNotification->n_title}}</td>
                                                  <td style="vertical-align: middle; width: 15%;">{{ $sentToStudentNotification->n_type == 6 ? 'GV: ' : 'SV: ' }}{{ isset($sentToStudentNotification->user) ? $sentToStudentNotification->user->name : '' }}</td>
                                                  <td style="vertical-align: middle; width: 20%;">
                                                      @if (isset($sentToStudentNotification->notificationUsers))
                                                          @foreach($sentToStudentNotification->notificationUsers as $item)
                                                              <p style="margin: 0px 0px 5px 0px">{{ $item->user->name }}</p>
                                                          @endforeach
                                                      @endif
                                                  </td>
                                                  <td style="vertical-align: middle; width: 10%;">{{ !empty($sentToStudentNotification->n_from_date) ? convertDatetimeLocal($sentToStudentNotification->n_from_date) : '' }}</td>
                                                  <td style="vertical-align: middle; width: 10%;">{{ !empty($sentToStudentNotification->n_end_date) ? convertDatetimeLocal($sentToStudentNotification->n_end_date) : '' }}</td>
                                                  <td style="vertical-align: middle; width: 10%;"><button type="button" class="btn btn-block {{ $sentToStudentNotification->pivot->nu_status == 1 ? 'bg-gradient-success' : 'bg-gradient-danger' }} btn-xs">{{ $sentToStudentNotification->pivot->nu_status == 1 ? 'Tham gia' : 'Không tham gia'}}</button></td>
                                              </tr>
                                              @php $i++ @endphp
                                          @endforeach
                                      @endif
                                  </tbody>
                              </table>
                              @if($sentToStudentNotifications->hasPages())
                                  <div class="pagination float-right margin-20">
                                      {{ $sentToStudentNotifications->appends($query = '')->links() }}
                                  </div>
                              @endif
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- các notifications được gửi đến student-->
                      <!-- /.card -->
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">Danh sách lịch hẹn giáo viên tham gia</h3>
                          </div>
                          <div class="card-body table-responsive p-0">
                              <table class="table table-hover text-nowrap table-bordered">
                                  <thead>
                                      <tr>
                                          <th width="5%" class=" text-center">STT</th>
                                          <th style="width: 30%;">Tên lịch hẹn</th>
                                          <th style="width: 15%;">Người tạo</th>
                                          <th style="width: 20%;">Đối tượng hẹn</th>
                                          <th style="width: 10%;">Bắt đầu</th>
                                          <th style="width: 10%;">Kết thúc</th>
                                          <th style="width: 10%;">Trạng thái tham gia của GV</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if (!$studentSentConfirmedNotifications->isEmpty())
                                          @php $i = $studentSentConfirmedNotifications->firstItem(); @endphp
                                          @foreach($studentSentConfirmedNotifications as $studentSentConfirmedNotification)
                                              <tr>
                                                  <td class=" text-center" style="vertical-align: middle; width: 5%;">{{ $i }}</td>
                                                  <td style="vertical-align: middle; width: 30%;">{{$studentSentConfirmedNotification->n_title}}</td>
                                                  <td style="vertical-align: middle; width: 15%;">{{ $studentSentConfirmedNotification->n_type == 6 ? 'GV: ' : 'SV: ' }}{{ isset($studentSentConfirmedNotification->user) ? $studentSentConfirmedNotification->user->name : '' }}</td>
                                                  <td style="vertical-align: middle; width: 20%;">
                                                      @if (isset($studentSentConfirmedNotification->notificationUsers))
                                                          @foreach($studentSentConfirmedNotification->notificationUsers as $item)
                                                              <p style="margin: 0px 0px 5px 0px">{{ $item->user->name }}</p>
                                                          @endforeach
                                                      @endif
                                                  </td>
                                                  <td style="vertical-align: middle; width: 10%;">{{ !empty($studentSentConfirmedNotification->n_from_date) ? convertDatetimeLocal($studentSentConfirmedNotification->n_from_date) : '' }}</td>
                                                  <td style="vertical-align: middle; width: 10%;">{{ !empty($studentSentConfirmedNotification->n_end_date) ? convertDatetimeLocal($studentSentConfirmedNotification->n_end_date) : '' }}</td>
                                                  <td style="vertical-align: middle; width: 10%;"><button type="button" class="btn btn-block bg-gradient-success btn-xs">Tham gia</button></td>
                                              </tr>
                                              @php $i++ @endphp
                                          @endforeach
                                      @endif
                                  </tbody>
                              </table>
                              @if($studentSentConfirmedNotifications->hasPages())
                                  <div class="pagination float-right margin-20">
                                      {{ $studentSentConfirmedNotifications->appends($query = '')->links() }}
                                  </div>
                              @endif
                          </div>
                      </div>
                       <!-- các notifications do student gửi đến teacher và teacher xác nhận tham gia-->
                      <!-- /.card -->
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">Danh sách lịch hẹn giáo viên không tham gia</h3>
                          </div>
                          <div class="card-body table-responsive p-0">
                              <table class="table table-hover text-nowrap table-bordered">
                                  <thead>
                                      <tr>
                                          <th width="5%" class=" text-center">STT</th>
                                          <th style="width: 30%;">Tên lịch hẹn</th>
                                          <th style="width: 15%;">Người tạo</th>
                                          <th style="width: 20%;">Đối tượng hẹn</th>
                                          <th style="width: 10%;">Bắt đầu</th>
                                          <th style="width: 10%;">Kết thúc</th>
                                          <th style="width: 10%;">Trạng thái tham gia của GV</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if (!$studentSentConfirmedNotNotifications->isEmpty())
                                          @php $i = $studentSentConfirmedNotNotifications->firstItem(); @endphp
                                          @foreach($studentSentConfirmedNotNotifications as $studentSentConfirmedNotNotification)
                                              <tr>
                                                  <td class=" text-center" style="vertical-align: middle; width: 5%;">{{ $i }}</td>
                                                  <td style="vertical-align: middle; width: 30%;">{{$studentSentConfirmedNotNotification->n_title}}</td>
                                                  <td style="vertical-align: middle; width: 15%;">{{ $studentSentConfirmedNotNotification->n_type == 6 ? 'GV: ' : 'SV: ' }}{{ isset($studentSentConfirmedNotNotification->user) ? $studentSentConfirmedNotNotification->user->name : '' }}</td>
                                                  <td style="vertical-align: middle; width: 20%;">
                                                      @if (isset($studentSentConfirmedNotNotification->notificationUsers))
                                                          @foreach($studentSentConfirmedNotNotification->notificationUsers as $item)
                                                              <p style="margin: 0px 0px 5px 0px">{{ $item->user->name }}</p>
                                                          @endforeach
                                                      @endif
                                                  </td>
                                                  <td style="vertical-align: middle; width: 10%;">{{ !empty($studentSentConfirmedNotNotification->n_from_date) ? convertDatetimeLocal($studentSentConfirmedNotNotification->n_from_date) : '' }}</td>
                                                  <td style="vertical-align: middle; width: 10%;">{{ !empty($studentSentConfirmedNotNotification->n_end_date) ? convertDatetimeLocal($studentSentConfirmedNotNotification->n_end_date) : '' }}</td>
                                                  <td style="vertical-align: middle; width: 10%;"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Không tham gia</button></td>
                                              </tr>
                                              @php $i++ @endphp
                                          @endforeach
                                      @endif
                                  </tbody>
                              </table>
                              @if($studentSentConfirmedNotNotifications->hasPages())
                                  <div class="pagination float-right margin-20">
                                      {{ $studentSentConfirmedNotNotifications->appends($query = '')->links() }}
                                  </div>
                              @endif
                          </div>
                      </div>
                       <!-- các notifications do student gửi đến teacher và teacher xác nhận không tham gia-->
                      <!-- /.card -->
                  </div>
              </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop