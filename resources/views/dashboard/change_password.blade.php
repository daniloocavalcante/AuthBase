@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Profile') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

                  

            <!-- Card de boas-vindas / resumo -->
            <div class="card text-center shadow-lg border-0 mb-3">
                <div class="card-header bg-secondary text-white">
                    Change Password
                </div>
                <div class="card-body">
                    <h5 class="card-title">Olá, <strong>{{ ucfirst(Auth::user()->name)}} {{ucfirst(Auth::user()->surname) }}</strong>!</h5>
                    <p class="card-text">Aqui você pode gerenciar seu perfil, alterar sua senha e visualizar a tabela de usuários.</p>
                    <a href="/dashboard/profile" class="btn btn-success me-2">
                        <i class="fa-solid fa-user me-1"></i> Editar perfil
                    </a>
                    <a href="/dashboard/users" class="btn btn-info">
                        <i class="fa-solid fa-table me-1"></i> Tabela de usuários
                    </a>
                </div>
                <div class="card-footer text-body-secondary">

                    tessssss
                </div>
            </div>
>

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

                        <a href="{{ route('dashboard.profile') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
                            <i class="fa-solid fa-user me-3 mt-1"></i>
                            <div>
                                <strong>Visualizar perfil</strong><br>
                                <small class="text-muted">Confira suas informações de conta.</small>
                            </div>
                        </a>

                        <a href="{{ route('dashboard.change-password') }}d" class="list-group-item list-group-item-action d-flex align-items-start py-3">
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

                        <a href="/dashboard/help" class="list-group-item list-group-item-action d-flex align-items-start py-3">
                            <i class="fa-solid fa-question-circle me-3 mt-1"></i>
                            <div>
                                <strong>Ajuda / FAQ</strong><br>
                                <small class="text-muted">Tire dúvidas sobre o uso do sistema.</small>
                            </div>
                        </a>

                    </div>

                </div>
            </div>
        </div>



    </div>
</div>
@endsection
