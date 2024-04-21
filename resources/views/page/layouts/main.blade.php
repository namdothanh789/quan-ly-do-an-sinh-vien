<!DOCTYPE html>
<html>
    @include('page.common.head')
<body>
<!-- Sidenav -->
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
        @include('page.common.nav')
    <!-- Header -->
    <!-- Header -->
    @yield('content')
</div>
<!-- Argon Scripts -->
<!-- Core -->
@include('page.common.script')
</body>

</html>
