<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/auth.js'])

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fs-3" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}">
                                        <i class="fa-solid fa-right-to-bracket me-1"></i> {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fa-solid fa-user-plus me-1"></i> {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-regular fa-user me-1"></i> {{ ucfirst(Auth::user()->name) }} {{ ucfirst(Auth::user()->surname) }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Dashboard -->
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fa-solid fa-compass me-1"></i> Dashboard
                                    </a>

                                    <!-- Visualizar perfil -->
                                    <a class="dropdown-item" href="{{ route('dashboard.profile') }}">
                                        <i class="fa-solid fa-user me-1"></i> Perfil
                                    </a> 

                                    <!-- Alterar senha -->
                                    <a class="dropdown-item" href="{{ route('dashboard.change-password') }}">
                                        <i class="fa-solid fa-key me-1"></i> Alterar senha
                                    </a>

                                    <!-- Tabela de usuários -->
                                    <a class="dropdown-item" href="{{ route('dashboard.users') }}">
                                        <i class="fa-solid fa-table me-1"></i> Usuários
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- Logout -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-1"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


<div class="container"> 
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center"> 
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none " aria-label="Bootstrap"> 
                <i class="fa-brands fa-bootstrap fa-2xl"></i>
            </a> 
            <span class="mb-3 mb-md-0 text-body-secondary">© 2025 {{ config('app.name', 'Laravel') }} </span>
        </div> 
        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex"> 
            <li class="ms-3"><a class="text-body-secondary" href="#" aria-label="Instagram">
                <i class="fa-brands fa-instagram fa-2xl"></i>
            </li> 
            <li class="ms-3"><a class="text-body-secondary" href="#" aria-label="Facebook">
                <i class="fa-brands fa-facebook fa-2xl"></i>
            </li> 
        </ul> 
    </footer> 
</div>

</body>
</html>
