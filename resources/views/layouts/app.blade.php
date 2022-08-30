<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Name - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('includes/libs/bootstrap-5.2.0-dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('includes/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('includes/libs/bootstrap-5.2.0-dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('includes/libs/bootstrap-5.2.0-dist/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('includes/libs/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('includes/libs/fontawesome-free-5.10.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('includes/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ URL::to('/'); }}">
    @yield('styles')
</head>

<body>
    <div id="mpreloader">
        <div class="load">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    @auth
        @include('layouts.header')
    @endauth
    <div class="container-fluid d-grid" style="min-height: 100vh;">
        @yield('content')
    </div>
    @include('layouts.footer')
    @yield('scripts')
    <script src="{{ asset('includes/js/app.js') }}"></script>
    <script src="{{ asset('includes/js/auth.js') }}"></script>
    <script src="{{ asset('includes/libs/sweetalert.min.js') }}"></script>
</body>

</html>
