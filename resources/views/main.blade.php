<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Department of Health</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="flex flex-col h-screen">
    @include('header')
    {{-- @include('footer') --}}

    <div class="flex flex-row flex-grow p-0 bg-[#E8E8E8]">
        @include('side_panel')
        @yield('welcome')
    </div>

</body>

</html>
