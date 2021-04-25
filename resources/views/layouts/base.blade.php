<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/argon.css') }}" type="text/css"> --}}

    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/quill/dist/quill.core.css">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link type="text/css" href="{{ asset('argon') }}/css/argon.min.css?v=1.0.0" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <div id="app">
        @yield('body')
    </div>

    <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/js-cookie/js.cookie.js"></script>

    @stack('js')

    <!-- Argon JS -->
    <script src="{{ asset('assets') }}/js/argon.js?v=1.1.0"></script>
    @stack('scripts')
</body>

</html>

<!DOCTYPE html>
<html>
