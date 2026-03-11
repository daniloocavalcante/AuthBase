@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Profile') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center g-4">

        <div class="col-md-7">
            <!-- Breadcrumb de Navegação -->
            <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-2">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">
                        Alterar Senha
                    </li>
                </ol>
            </nav>

            <div class="card shadow-lg border-0">
                
                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Alterar Senha</span>
                    <span class="badge bg-primary">{{ $user->privilege }}</span>
                </div>

                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="row mb-3">                        
                            <label class="col-5 col-form-label text-muted">
                                <i class="fa-solid fa-lock me-1"></i>
                                Senha Atual
                            </label>
                            <div class="col-7">
                                <input type="password" name="current_password" class="form-control form-control-sm" placeholder="Digite sua senha atual">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-5 col-form-label text-muted">
                                <i class="fa-solid fa-lock me-1"></i>
                                Nova Senha
                            </label>
                            <div class="col-7">

                                <div class="input-group">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="Digite sua senha"
                                        required>

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="eyeButton"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Mostrar/Esconder"
                                            aria-label="Mostrar/Esconder">
                                        <i id="eyeIcon" class="fa-solid fa-eye"></i>

                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-5 col-form-label text-muted">
                                <i class="fa-solid fa-lock me-1"></i>
                                Confirmar Nova Senha
                            </label>    
                            <div class="col-7">
                                
                                <div class="input-group">
                                    <input
                                        id="passwordConfirmation"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        placeholder="Repita sua senha"
                                        required>

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="eyeButtonConfirmation"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Mostrar/Esconder"
                                            aria-label="Mostrar/Esconder">
                                        <i id="eyeIconConfirmation" class="fa-solid fa-eye"></i>

                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-light d-flex justify-content-end gap-2 flex-wrap">
                        
                        <a href="{{ route('profile') }}" class="btn btn-outline-dark btn-sm">
                            Voltar
                        </a>

                        <button type="submit" class="btn btn-success btn-sm">
                            Alterar Senha
                        </button>

                    </div>

                </form>
            </div>


            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-dark text-white">
                    <i class="fa-solid fa-lightbulb me-2"></i> Dicas de Segurança
                </div>
                <div class="card-body bg-white small">
                    <ul class="mb-0 ps-3">
                        <li>Use pelo menos <strong>8 caracteres</strong>.</li>
                        <li>Combine letras maiúsculas, minúsculas, números e símbolos.</li>
                        <li>Evite senhas óbvias como <em>123456</em> ou <em>senha</em>.</li>
                        <li>Não reutilize senhas de outros serviços.</li>
                        <li>Atualize sua senha periodicamente.</li>
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

                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
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
