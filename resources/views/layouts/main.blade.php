<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sistem Informasi Monitoring Akademik Informatika | {{ $title }} </title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Monitoring Akademik Informatika Universitas Diponegoro">
    <meta name="author" content="Kelompok 4 PPL 2022">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/undip.png') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/dropzone/dist/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flatpickr/dist/flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

    <!-- Theme CSS -->
    <link id="style-switch" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

</head>

<body>

    @yield('content')

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendors -->
    <script src="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/vendor/OverlayScrollbars-master/js/OverlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox-master/dist/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/plyr/plyr.js') }}"></script>

    <!-- Template Functions -->
    <script src="{{ asset('assets/js/template.js') }}"></script>

    <!-- Scripts -->
    @yield('script')

</body>

</html>