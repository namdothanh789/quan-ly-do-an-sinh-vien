@extends('page.layouts.main')
@section('title')
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
            <div class="col-xl-6" style="margin: auto">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col" style="flex-basis: unset !important;">
                            <h3 class="mb-0" style="text-transform: uppercase;">THÔNG BÁO / LỊCH HẸN</h3>
                        </div>
                        <div class="col text-right"></div>
                    </div>
                </div>
                <div class="col=md-12">
                    <div class="table-responsiver">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            @foreach ($notifications as $notification)
                                <tr>
                                    <th>
                                        <a href="{{ route('user.notifications.details', $notification->id) }}">
                                            {{ $notification->n_title }}
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                            </thead>
                        </table>
                        @if($notifications->hasPages())
                            <div class="pagination float-right margin-20">
                                {{ $notifications->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop