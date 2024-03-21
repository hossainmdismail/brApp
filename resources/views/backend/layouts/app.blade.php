<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/assets/imgs/theme/favicon.svg">
    <!-- Template CSS -->
    <link href="{{ asset('backend') }}/assets/css/main.css" rel="stylesheet" type="text/css" />
    <!-- include summernote css/js -->
    {{-- <script src="{{ asset('backend') }}/assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/vendors/jquery.fullscreen.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}

    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
    <main>
        <section class="content-main mt-80 mb-80">
            @yield('content')
        </section>
        {{-- <footer class="main-footer text-center">
            <p class="font-xs">
                <script>
                document.write(new Date().getFullYear())
                </script> ©, Evara - HTML Ecommerce Template .
            </p>
            <p class="font-xs mb-30">All rights reserved</p>
        </footer> --}}
    </main>
    {{-- <script src="{{ asset('backend') }}/assets/js/vendors/jquery-3.6.0.min.js"></script> --}}

    <!-- Main Script -->
    <script src="{{ asset('backend') }}/assets/js/main.js" type="text/javascript"></script>
    @yield('script')
</body>

</html>
