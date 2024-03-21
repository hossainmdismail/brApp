<?php
use App\Models\Config;
use App\Models\CustomLink;

$config = Config::first();
$link = CustomLink::first();
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Familly Bazar">
    {!! SEO::generate() !!}
    @if ($config)
        <link rel="shortcut icon" href="{{ asset('files/config/'.$config->logo) }}" type="image/x-icon">
    @endif
    <link rel='stylesheet' href='{{ asset('frontend/css/icon.css') }}'>
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/maind134.css?v=3.4">
    {!! $link? $link->header:null !!}
    @yield('style')
    @livewireStyles
</head>

<body class="relative">
    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

    @yield('script')
    {!! $link? $link->body:null !!}

    <!-- Vendor JS-->
    <script src="{{ asset('frontend') }}/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{ asset('frontend') }}/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/slick.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/wow.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/jquery-ui.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/magnific-popup.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/select2.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/waypoints.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/counterup.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/images-loaded.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/isotope.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/scrollup.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend') }}/js/maind134.js?v=3.4"></script>
    <script src="{{ asset('frontend') }}/js/shopd134.js?v=3.4"></script>
    @livewireScripts

</body>
</html>
