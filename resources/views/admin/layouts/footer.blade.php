<footer class="footer footer-static footer-light navbar-border">

    <div class="copy_right">
        <div class="d-md-flex align-items-md-center justify-content-md-between">
            <p class="mb-0">جميع الحقوق محفوظة &copy; 2022</p>
            <a href=""><img src="https://topline.com.sa/logo/topline-logo-dark.png" alt=""></a>
        </div>
    </div>
{{--    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">--}}
{{--        <span class="float-md-left d-block d-md-inline-block">Copyright  &copy; 2018 --}}
{{--            <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT </a>,--}}
{{--            All rights reserved. </span>--}}
{{--        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span></p>--}}
</footer>
<!-- BEGIN VENDOR JS-->
<script src="{{asset('admin/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>--}}
{{--<script> $('.dropify').dropify(); </script>--}}
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('admin/app-assets/vendors/js/charts/raphael-min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/charts/morris.min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/charts/chart.min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/extensions/underscore-min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/extensions/clndr.min.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/charts/echarts/echarts.js')}}"></script>
<script src="{{asset('admin/app-assets/vendors/js/extensions/unslider-min.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="{{asset('admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('admin/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('admin/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{--<script src="{{asset('admin/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>--}}
<!-- END PAGE LEVEL JS-->

<script type="text/javascript" src="{{ asset('admin/assets/js/custom.js') }}?t={{ rand(1,100) }}"></script>

{{--tiny editor--}}
<script src="https://cdn.tiny.cloud/1/eg7fmo3qxhdcmnt58klb91x46o0zry42r1n2z5g6cc5wj9j9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
{{--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>--}}
<script>
    tinymce.init({
        selector:'textarea#tinymce',
        font_formats:"Segoe UI=Segoe UI;",
        fontsize_formats: "8px 9px 10px 11px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px 42px 44px 46px 48px 50px 52px 54px 56px 58px 60px 62px 64px 66px 68px 70px 72px 74px 76px 78px 80px 82px 84px 86px 88px 90px 92px 94px 94px 96px",
        height: 600
    });
</script>

@yield('js')
@stack('scripts')
</body>
</html>
