<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', config('app.locale')) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.display_name') }} - @yield('page-title')</title>
    <!-- favicon !-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @stack('styles')
    @stack('header')
</head>
<body>
    @yield('page-content')
    @stack('scripts')
</body>
</html>