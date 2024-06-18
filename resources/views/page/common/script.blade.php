<script src="{{ asset('page/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('page/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('page/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('page/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('page/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
<!-- toastr -->
<script src="{!! asset('admin/plugins/toastr/toastr.min.js') !!}"></script>
<script src="{{ asset('page/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    toastr.options.closeButton = true;
            @if(session('success'))
    var message = "{{ session('success') }}";
    toastr.success(message, {timeOut: 3000});
            @endif
            @if(session('error'))
    var message = "{{ session('error') }}";
    toastr.error(message, {timeOut: 3000});
    @endif
    setTimeout(function(){ toastr.clear() }, 3000);
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

</script>

<script src="{!! asset('page/js/main.js') !!}"></script>
@yield('script')
@stack('scripts')