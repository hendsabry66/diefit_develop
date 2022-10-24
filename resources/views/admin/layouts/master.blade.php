@include('admin.layouts.header')
<!-- fixed-top-->
@include('admin.layouts.nav')
<!-- ////////////////////////////////////////////////////////////////////////////-->


<!-- Menue -->
@include('admin.layouts.menue')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            @yield('breadcrumb')
        </div>
        <div class="content-body"><!-- Sales stats -->
            @yield('content')
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->


@include('admin.layouts.footer')
