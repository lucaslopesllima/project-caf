<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'C.A.F') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"/>
        <title>C.A.F</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-montserrat overflow-hidden">
        <x-theme-selector/>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-20 sm:pt-0">
            <div class="card bg-base-100 shadow-x2 w-full sm:max-w-md mt-20 sm:mt-8 px-6">
                {{ $slot }}
                @yield('content')
            </div>
        </div>
    </body>
</html>
