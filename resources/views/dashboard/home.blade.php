@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Home') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center g-3">
        <div class="col-md-7">

            <!-- Alert de login -->
            <div class="alert alert-success alert-dismissible fade show">
                <p class="mb-0">Olá, <strong>{{ ucfirst(Auth::user()->name) }}</strong> ! Você foi logado com sucesso!</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>                  
            </div>                     

            <!-- Card de boas-vindas / resumo -->
            <div class="card text-center shadow-lg border-0 mb-3">
                <div class="card-header bg-secondary text-white">
                    Bem-vindo ao seu Dashboard
                </div>
                <div class="card-body">
                    <h5 class="card-title">Olá, <strong>{{ ucfirst(Auth::user()->name)}} {{ucfirst(Auth::user()->surname) }}</strong>!</h5>
                    <p class="card-text">Aqui você pode gerenciar seu perfil, alterar sua senha e visualizar a tabela de usuários.</p>
                    <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-success me-2">
                        <i class="fa-solid fa-user me-1"></i> Editar perfil
                    </a>
                    <a href="{{ route('dashboard.users') }}" class="btn btn-info">
                        <i class="fa-solid fa-table me-1"></i> Tabela de usuários
                    </a>
                </div>
                <div class="card-footer text-body-secondary">                    
                    Último login: {{ session('previous_login') ? session('previous_login')->diffForHumans() : 'Primeiro acesso' }}
                </div>
            </div>

            <!-- Card de dicas ou atalhos -->
            <div class="card shadow-lg border-0">
                <div class="card-header">
                    Dicas rápidas
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 text-start">
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Mantenha sua senha atualizada</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Explore a tabela de usuários para teste</li>
                        <li><i class="fa-solid fa-circle-check text-success me-2"></i> Use os atalhos do guia rápido para navegar mais rápido</li>
                    </ul>
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
