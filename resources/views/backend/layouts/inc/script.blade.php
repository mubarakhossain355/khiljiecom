<!-- Vendor Scripts Start -->
<script src="{{ asset('assets/backend') }}/js/vendor/jquery-3.5.1.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/vendor/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/vendor/OverlayScrollbars.min.js"></script>

<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="{{ asset('assets/backend') }}/font/CS-Line/csicons.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/base/helpers.js"></script>
<script src="{{ asset('assets/backend') }}/js/base/globals.js"></script>
<script src="{{ asset('assets/backend') }}/js/base/nav.js"></script>
<script src="{{ asset('assets/backend') }}/js/base/search.js"></script>
<script src="{{ asset('assets/backend') }}/js/base/settings.js"></script>
<script src="{{ asset('assets/backend') }}/js/base/init.js"></script>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
 {!! Toastr::message() !!}
<!-- Template Base Scripts End -->

@stack('admin_script')
