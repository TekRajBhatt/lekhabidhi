<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @csrf
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/date.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toggle_button.css') }}">
    <script src="{{ asset('/assets/front/js/jquery.min.js') }}" type="text/javascript"></script>
    <!-- include libraries(jQuery, bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    @stack('styles')
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
