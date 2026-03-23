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
                        @endguest

                        @auth  
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard.index') }}">
                                    Início
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard.users') }}">
                                    <i class="fa-solid fa-users me-1"></i>Usuários
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-regular fa-user me-1"></i> {{ Str::title(Auth::user()->name) }} {{ Str::title(Auth::user()->surname) }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                    <!-- Perfil -->
                                    <a class="dropdown-item" href="{{ route('dashboard.profile') }}">
                                        <i class="fa-solid fa-user me-2"></i> Perfil
                                    </a> 

                                    <!-- Perfil -->
                                    <a class="dropdown-item" href="{{ route('dashboard.profile.edit') }}">
                                        <i class="fa-solid fa-user-pen me-2"></i> Editar Perfil
                                    </a> 

                                    <!-- Alterar senha -->
                                    <a class="dropdown-item" href="{{ route('dashboard.password.edit') }}">
                                        <i class="fa-solid fa-key me-2"></i> Alterar senha
                                    </a>



                                    <div class="dropdown-divider"></div>

                                    <!-- Logout -->
                                    <a href="#" class="dropdown-item text-black" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Sair
                                    </a>

                                </div>
                            </li>
                        @endauth
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



<!-- Modal de Logout -->

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">

      <!-- Cabeçalho -->
      <div class="modal-header bg-light">
        <h5 class="modal-title fw-semibold" id="logoutModalLabel">
            <i class="fa-solid fa-right-from-bracket me-2 text-danger"></i>
            Sair da conta
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body text-muted">
        Tem certeza que deseja sair da sua conta?<br>
        Você poderá entrar novamente a qualquer momento.
      </div>

      <!-- Rodapé -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Cancelar
        </button>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                Sair
            </button>
        </form>
      </div>

    </div>
  </div>
</div>

</body>
</html>
