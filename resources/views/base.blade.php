<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href=""/>
    <title>@yield('title')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" data-kt-app-page-loading-enabled="true" data-kt-app-page-loading="on"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
@include('partials/theme-mode/_init')
@include('partials/_loader')
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include('layout/header/_base')
            @include('layout/_toolbar')
            <!--begin::Container-->
            <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start  container-xxl ">
                <!--begin::Post-->
                <div class="content flex-row-fluid" id="kt_content">
                    <!--begin::Row-->
                    <div class="row gy-0 gx-10">
                        @yield('content')
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Container-->
            @include('layout/_footer')
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
{{--@include('partials/_drawers')--}}
<!--end::Main-->
{{--@include('partials/_scrolltop')--}}
<!--begin::Modals-->
{{--@include('partials/modals/create-campaign/_main')--}}
{{--@include('partials/modals/_invite-friends')--}}
{{--@include('partials/modals/users-search/_main')--}}
<!--end::Modals-->
<!--begin::Javascript-->
<script>
    var hostUrl = "assets/";        </script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>


<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
{{--<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/custom/utilities/modals/create-campaign.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>--}}
<!--end::Custom Javascript-->
<!--end::Javascript-->

@yield('script')
</body>
<!--end::Body-->
</html>
