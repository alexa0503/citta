<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('vendor/cms/favicon.png') }}">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('vendor/cms/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cms/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cms/css/style.css') }}">
</head>

<body>
    @yield('content')

    <!-- plugins:js -->
    <script src="{{asset('vendor/cms/base/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{asset('vendor/cms/js/off-canvas.js')}}"></script>
    <script src="{{asset('vendor/cms/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('vendor/cms/js/template.js')}}"></script>
    <script src="{{asset('vendor/cms/js/app.js')}}"></script>
    <!-- endinject -->
    @yield('scripts')
</body>

</html>
