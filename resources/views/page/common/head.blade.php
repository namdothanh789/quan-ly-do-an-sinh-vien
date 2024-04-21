<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Quản lý đồ án')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('page/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('page/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('page/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('page/css/argon.css?v=1.2.0') }}" type="text/css">
    <link rel="stylesheet" href="{!! asset('admin/plugins/toastr/toastr.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('page/vendor/sweetalert2/dist/sweetalert2.min.css') !!}">
    <link rel="stylesheet" href="{{ asset('page/css/style.css') }}" type="text/css">
    @yield('style')
</head>