<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{config('app.name')}}">
    <meta name="author" content="{{config('app.name')}}">
    <meta name="keywords" content="{{config('app.name')}}">
    <title>{{config('app.name')}} | @yield('title')</title>
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}" />
    <script src="{{asset('admin/assets/js/color-modes.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-free-7.0.0-web/css/all.min.css')}}">
    @stack('style-library')
    <link rel="stylesheet" href="{{asset('admin/assets/css/demo1/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/custom.css')}}">
    @stack('style')
</head>
<body class="sidebar-dark">
@include('sweetalert::alert')
<div class="main-wrapper">
    @include('admin.layouts.side-bar')
    <div class="page-wrapper">
       @include('admin.layouts.nav-bar')
        <div class="page-content">
            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                    <h4 class="mb-3 mb-md-0">@yield('title')</h4>
                </div>
            </div>
            @section('content') @show
        </div>

        @include('admin.layouts.footer')

    </div>
</div>

<script src="{{asset('admin/assets/vendors/core/core.js')}}"></script>
<script src="{{asset('admin/assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('admin/assets/js/app.js')}}"></script>
<script src="{{asset('admin/assets/js/dashboard.js')}}"></script>
<script src="{{asset('jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('jq-validation/jquery.validate.js')}}"></script>
<script src="{{asset('jq-validation/additional-methods.js')}}"></script>
@stack('script-library')
<script>
    if (!window.onDocumentReady) {
        function onDocumentReady(callback, isFullyLoaded = true) {
            switch (document.readyState) {
                case "loading":
                    document.addEventListener("DOMContentLoaded", callback);
                    break;
                case "interactive": {
                    if (!isFullyLoaded) {
                        setTimeout(callback, 500);
                    }
                    break;
                }
                case "complete":
                    callback();
                    break;
                default:
                    document.addEventListener("DOMContentLoaded", callback);
            }
        }
    }
</script>
@stack('script')

</body>

</html>
