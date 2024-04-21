@extends('page.layouts.main')
@section('title')
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
            @include('page.common.breadcrumb')
            <!-- Card stats -->

            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col" style="flex-basis: unset !important;">
                            <h3 class="mb-0" style="text-transform: uppercase;">Giới thiệu</h3>
                        </div>

                    </div>
                    <br />
                    <div class="row">

                    </div>
                    <br />
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('page.common.footer')
    </div>
@stop