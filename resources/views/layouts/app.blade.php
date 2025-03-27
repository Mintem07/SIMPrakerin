<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Login' }} - SIM Prakerin</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendors/choices.js/choices.min.css')}}" />

    <link rel="dns-prefetch" href="{{url('//fonts.bunny.net')}}">
    <link href="{{url('https://fonts.bunny.net/css?family=Nunito')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/toastify/toastify.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon">

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
</head>

<body>

    @yield('content')

    @if(session('success'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Toastify({
            text: "{{ session('success') }}",
            duration: 2500,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "linear-gradient(to bottom right, #4fbe87, #a8e063)",
        }).showToast();
    });
    </script>
    @endif

    @if(session('error'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Toastify({
            text: "{{ session('error') }}",
            duration: 2500,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "linear-gradient(to bottom right, #ff5f6d,rgb(234, 144, 48))",
        }).showToast();
    });
    </script>
    @endif

    <!-- js -->
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('assets/vendors/toastify/toastify.js')}}"></script>
    <script src="{{asset('assets/js/extensions/toastify.js')}}"></script>

    <script src="{{asset('assets/vendors/choices.js/choices.min.js')}}"></script>

    <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>