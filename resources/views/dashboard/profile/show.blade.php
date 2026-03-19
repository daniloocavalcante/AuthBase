@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Profile') }}
@endsection

@section('content')
<div class="container">
    
    <div class="row justify-content-center g-3">
        <div class="col-md-7">
            
            <!-- Breadcrumb de Navegação -->
            <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-2">
                <ol class="breadcrumb mb-0 small">

                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">
                        Meu Perfil
                    </li>

                </ol>
            </nav>


            {{-- Mensagens do servidor --}}
            @include('layouts.messages')
            
            <div class="card shadow-lg border-0">


                <!-- Header -->

                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">

                        <div class="me-3 text-primary fs-4">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>
                            <h6 class="mb-0 fw-semibold">
                                Meu Perfil
                            </h6>

                            <small class="text-muted d-block">
                                Informações sobre meu perfil
                            </small>

                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row justify-content-center">

                        <!-- Foto -->
                        <div class="col-md-4 text-center border-end">

                            <img src="{{ asset('storage/photos_users/default.png') }}?v=2"
                                class="img-fluid rounded-circle shadow mb-3"
                                style="width:120px;height:120px;object-fit:cover;">

                            <!-- Badge -->
                                                        
                            <div class="mb-3">
                                    <span class="badge bg-{{ $user->privilege->badge_color }} fs-6 rounded-pill" >
                                        {{ ucfirst($user->privilege->name) }}
                                    </span>
                            </div>

                            <h5 class="mb-0">{{ $user->name }} {{ $user->surname }}</h5>

                            <small class="text-muted">
                                Usuário desde {{ $user->created_at->format('d/m/Y') }}
                            </small>

                        </div>

                        <!-- Dados -->
                        <div class="col-md-8">

                            <div class="row mb-3">                                
                                <label class="col-5 col-form-label text-muted">
                                    <i class="fa-solid fa-user me-1"></i>
                                    Nome
                                </label>
                                <div class="col-7 fw-semibold">{{ $user->name }}</div>
                            </div>

                            <div class="row mb-3">                                
                                <label class="col-5 col-form-label text-muted">
                                    <i class="fa-solid fa-user-tag me-1"></i>
                                    Sobrenome
                                </label>
                                <div class="col-7 fw-semibold">{{ $user->surname }}</div>
                            </div>

                            <div class="row mb-3">

                                <label class="col-5 col-form-label text-muted">
                                    <i class="fa-solid fa-envelope me-1"></i>
                                    E-mail
                                </label>
                                <div class="col-7 fw-semibold">
                                    {{ $user->email }}

                                    @if($user->email_verified_at)
                                        <i class="fa-solid fa-circle-check text-success ms-2"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Email verificado"></i>
                                    @else
                                        <i class="fa-regular fa-circle-check text-secondary ms-2"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Email não verificado"></i>
                                    @endif

                                </div>
                            </div>
                            <div class="row mb-3">                                
                                <label class="col-5 col-form-label text-muted">
                                    <i class="fa-solid fa-calendar-days me-1"></i>
                                    Data de nascimento
                                </label>
                                <div class="col-7 fw-semibold">
                                    {{ $user->birth->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-5 col-form-label text-muted">
                                    <i class="fa-solid fa-venus-mars me-1"></i>
                                    Gênero
                                </label>
                                <div class="col-7 fw-semibold">{{ $user->gender }}</div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-5 col-form-label text-muted">
                                    <i class="fa-solid fa-history me-1"></i>
                                    Último login
                                </label>

                                <div class="col-7 fw-semibold">
                                    {{ $user->last_login?->diffForHumans() ?? 'Nunca acessou' }}
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="card-footer bg-light d-flex justify-content-end gap-2 flex-wrap">

                    <a href="{{ route('dashboard.password.edit') }}" class="btn btn-outline-dark btn-sm">
                        Alterar Senha
                    </a>
                    
                    <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-outline-primary btn-sm">
                        Editar Perfil
                    </a>
                </div>

            </div>

        </div>

        <!-- Card guia rápido -->

        <div class="col-lg-4 col-md-5">
            <div class="card shadow-lg border-0">

                <div class="card-header bg-light fw-semibold">
                    <i class="fa-solid fa-compass me-2"></i>
                    Guia rápido
                </div>

                <div class="card-body">

                    <p class="text-muted small">
                        Acesse rapidamente as principais funções do seu dashboard.
                    </p>

                    <div class="list-group">

                        <a href="{{ route('dashboard.index') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
                            <i class="fa-solid fa-gauge me-3 mt-1"></i>
                            <div>
                                <strong>Dashboard</strong><br>
                                <small class="text-muted">Volte para a página principal do painel.</small>
                            </div>
                        </a>

                        <a href="{{ route('dashboard.profile') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
                            <i class="fa-solid fa-user me-3 mt-1"></i>
                            <div>
                                <strong>Visualizar perfil</strong><br>
                                <small class="text-muted">Confira suas informações de conta.</small>
                            </div>
                        </a>

                        <a href="{{ route('dashboard.profile.edit') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
                            <i class="fa-solid fa-user-pen me-3 mt-1"></i>
                            <div>
                                <strong>Editar perfil</strong><br>
                                <small class="text-muted">Atualize seus dados pessoais.</small>
                            </div>
                        </a>

                        <a href="{{ route('dashboard.password.edit') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
                            <i class="fa-solid fa-key me-3 mt-1"></i>
                            <div>
                                <strong>Alterar senha</strong><br>
                                <small class="text-muted">Atualize sua senha de forma segura.</small>
                            </div>
                        </a>

                        <a href="{{ route('dashboard.users') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
                            <i class="fa-solid fa-table me-3 mt-1"></i>
                            <div>
                                <strong>Tabela de usuários</strong><br>
                                <small class="text-muted">Visualize todos os usuários cadastrados.</small>
                            </div>
                        </a>

                    </div>

                </div>
            </div>
        </div>



        

    </div>
</div>

@endsection
