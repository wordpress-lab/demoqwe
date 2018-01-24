<!DOCTYPE html>
<!--[if lte IE 9]>
    <html class="lte-ie9" lang="en">
<![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" ng-app="app">
<!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no" />

    <link rel="icon" type="image/png" href="{{ url('admin/assets/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ url('admin/assets/img/favicon-32x32.png') }}" sizes="32x32">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- uikit -->
    <link rel="stylesheet" href="{{ url('admin/bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ url('admin/assets/icons/flags/flags.min.css') }}" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/style_switcher.min.css') }}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/main.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ url('admin/assets/css/custom.css') }}" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/themes/themes_combined.min.css') }}" media="all">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    <script type="text/javascript" src="{{ url('admin/bower_components/matchMedia/matchMedia.js') }}"></script>
    <script type="text/javascript" src="{{ url('admin/bower_components/matchMedia/matchMedia.addListener.js') }}"></script>
    <link rel="stylesheet" href="{{ url('admin/assets/css/ie.css') }}" media="all">
    <![endif]-->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.4.4/sweetalert2.min.css">
    @yield('styles')
</head>

<body class="sidebar_main_open sidebar_main_swipe header_double_height">

@yield('header')

@yield('sidebar')

@yield('top_bar')

<div id="page_content">
    <div id="page_content_inner">

        @include('inc.alert')
        @yield('content')

    </div>
</div>


<div id="sidebar_secondary">
    <div class="sidebar_secondary_wrapper uk-margin-remove"></div>
</div>




<!-- google web fonts -->
<script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:400,300,500,700,400italic:latin'
            ]
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>

<!-- common functions -->
<script src="{{ url('admin/assets/js/common.min.js') }}"></script>
<!-- uikit functions -->
<script src="{{ url('admin/assets/js/uikit_custom.min.js') }}"></script>
<!-- altair common functions/helpers -->
<script src="{{ url('admin/assets/js/altair_admin_common.min.js') }}"></script>

<!-- page specific plugins -->
<!-- handlebars.js -->
<script src="{{ url('admin/bower_components/handlebars/handlebars.min.js') }}"></script>
<script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js') }}"></script>

<!--  invoices functions -->
<script src="{{ url('admin/assets/js/pages/page_invoices.min.js') }}"></script>

<script>
    $(function() {
        if (isHighDensity()) {
            $.getScript("admin/bower_components/dense/src/dense.js", function() {
                // enable hires images
                altair_helpers.retina_images();
            });
        }
        if (Modernizr.touch) {
            // fastClick (touch devices)
            FastClick.attach(document.body);
        }
    });
    $window.load(function() {
        // ie fixes
        altair_helpers.ie_fix();
    });
</script>

<script src="{{url('angular/angular.min.js')}}"></script>

@yield('scripts')
@yield('sweet_alert')

</body>

</html>