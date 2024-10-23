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
    <meta name="author" content="{{ $config ? $config->name : '' }}">
    {!! SEO::generate() !!}
    @if ($config)
        <link rel="shortcut icon" href="{{ asset('files/config/' . $config->fav) }}" type="image/x-icon">
    @endif
    <link rel='stylesheet' href='{{ asset('frontend/css/icon.css') }}'>
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/maind134.css?v=3.4">
    {!! $link ? $link->header : null !!}
    @yield('style')
    @livewireStyles
</head>

<body class="relative">

    <!-- Modal -->
    <div class="modal" id="searchModal" tabindex="-1" role="dialog" style="z-index: 999999">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{-- Product Search --}}
                    @livewire('frontend.search')
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

    @yield('script')
    {!! $link ? $link->body : null !!}

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
    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Get all input fields with the class 'openSearchModal'
            var openSearchInputs = document.getElementsByClassName('openSearchModal');
            var searchModal = document.getElementById('searchModal');

            // Loop through each input field and attach event listeners
            for (var i = 0; i < openSearchInputs.length; i++) {
                openSearchInputs[i].addEventListener('click', toggleModal);
                openSearchInputs[i].addEventListener('focus', toggleModal);
            }

            // Function to toggle the modal display
            function toggleModal() {
                searchModal.style.display = 'block';
            }

            // Close the modal when the close button is clicked
            searchModal.addEventListener('click', function(event) {
                if (event.target === searchModal) {
                    searchModal.style.display = 'none';
                }
            });

            // Close the modal when the Escape key is pressed
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    searchModal.style.display = 'none';
                }
            });
        });
    </script>
    @livewireScripts

</body>

</html>
