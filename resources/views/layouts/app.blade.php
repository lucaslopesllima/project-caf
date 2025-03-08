<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'C.A.F') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-montserrat">
    <div class="md:flex md:flex-row">
        <div class="lg:w-1/6 lg:h-screen h-3 lg:flex lg:flex-col">
            <button class="md:hidden z-1 mt-4 ms-4" id="menu-toggle">☰</button>
            <aside class="fixed md:relative inset-y-0 left-0 w-64 bg-base-200 p-4 z-50 transition-transform transform -translate-x-full md:translate-x-0 md:h-full" id="sidebar">
                <x-theme-selector />
                <button class="md:hidden" id="close-toggle">&larr;</button>
                <h1 class="text-xl font-bold mb-4">C.A.F</h1>
                <ul class="menu menu-vertical p-0">
                    <li class="">Página Inicial</li>
                    <li class="menu-title">Menus</li>
                    <li><a href="#">Beneficiarios</a></li>
                    <li><a href="{{ route('profile.index') }}">Usuários</a></li>
                    <li><a href="#">Projetos</a></li>
                    <li><a href="#">Questionarios</a></li>
                    <li><a href="#">Perguntas</a></li>
                    <li><a href="{{ route('logout')}}">Sair</a></li>
                </ul>
            </aside>
        </div>
        <div class="w-full lg:w-5/6 lg:flex lg:justify-center">
            {{ $slot }}
        </div>
    </div>
</body>

</html>