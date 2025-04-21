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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-montserrat">
    @if(session('success'))
        <div class="alert alert-success" class="flash-alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert bg-red-950" class="flash-alert">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li class="text-white">{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="md:flex md:flex-row">
        <div class="lg:w-1/6 lg:h-screen h-3 lg:flex lg:flex-col">
            <button class="md:hidden z-1 mt-4 ms-4" id="menu-toggle">☰</button>
            <aside class="fixed md:relative inset-y-0 left-0 w-64 bg-base-200 p-4 z-50 transition-transform transform -translate-x-full md:translate-x-0 md:h-full" id="sidebar">
                <x-theme-selector />
                <button class="md:hidden" id="close-toggle">&larr;</button>
                <h1 class="text-xl font-bold mb-4">C.A.F</h1>
                <ul class="menu menu-vertical p-0 ">
                    <li class=""><a href="{{ route('dashboard')}}">Página Inicial</a></li>
                    <li class="menu-title">Menus</li>
                    <li><a href="{{ route('profile.index')}}">Usuários</a></li>
                    <li><a href="{{ route('pessoa.index')}}">Beneficiarios</a></li>
                    <li><a href="{{ route('questionario.index') }}">Questionarios</a></li>
                    <li><a href="{{ route('pergunta.index')}}">Perguntas</a></li>
                    <li><a href="{{ route('solved_questionnairies')}}">Questionarios Respondidos</a></li>
                    <li><form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" >
                            Sair
                        </button>
                    </form></li>
                </ul>
            </aside>
        </div>
        <div class="w-full">
            {{ $slot }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashAlert = document.querySelector('.flash-alert');
            if (flashAlert) {
                setTimeout(function() {
                    flashAlert.style.opacity = '0';
                    flashAlert.style.transition = 'opacity 0.5s ease';
                    setTimeout(function() {
                        flashAlert.remove();
                    }, 500);
                }, 3000); 
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <style>
        #flash-alert{
            position: absolute;
            z-index: 100;
        }
    </style>
</body>

</html>