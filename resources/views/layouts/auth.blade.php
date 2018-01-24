<!DOCTYPE html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta content="no" name="msapplication-tap-highlight">
    <link href="{{ url('admin/assets/img/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png">
    <link href="'{{ url('admin/assets/img/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png">
    <title>@yield('title')</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    <!-- uikit -->
    <link href="{{ url('admin/bower_components/uikit/css/uikit.almost-flat.min.css') }}" rel="stylesheet">
    <!-- login page -->
    <link href="{{ url('admin/assets/css/login_page.min.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="login_page">
@yield('content')
<!-- common functions -->
<script src="{{ url('admin/assets/js/common.min.js') }}"></script>
<!-- uikit functions -->
<script src="{{ url('admin/assets/js/uikit_custom.min.js') }}"></script>
<!-- altair core functions -->
<script src="{{ url('admin/assets/js/altair_admin_common.min.js') }}"></script>
@yield('scripts')
</body>
</html>