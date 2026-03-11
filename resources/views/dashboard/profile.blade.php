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
                        <a href="{{ route('dashboard') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item active text-white" aria-current="page">
                        Meu Perfil
                    </li>

                </ol>
            </nav>
            
            <div class="card shadow-lg border-0">

                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Meu Perfil</span>
                    <span class="badge bg-primary">{{ $user->privilege }}</span>
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
                                <span class="badge bg-primary fs-6 rounded-pill">
                                    Administrador
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

                    <a href="{{ route('dashboard.change-password') }}" class="btn btn-outline-primary btn-sm">
                        Alterar Senha
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark btn-sm">
                        Editar Perfil
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        Excluir Conta
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

                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
                            <i class="fa-solid fa-user me-3 mt-1"></i>
                            <div>
                                <strong>Visualizar perfil</strong><br>
                                <small class="text-muted">Confira suas informações de conta.</small>
                            </div>
                        </a>

                        <a href="{{ route('dashboard.change-password') }}" class="list-group-item list-group-item-action d-flex align-items-start py-3">
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


<!-- Modal de confirmação -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteAccountLabel">
            <i class="fa-solid fa-triangle-exclamation me-2"></i>
            Confirmar Exclusão
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <div class="modal-body">
        Tem certeza que deseja excluir sua conta? <br>
        Essa ação <strong>não poderá ser desfeita</strong>.
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir Conta</button>
        </form>
      </div>

    </div>
  </div>
</div>



@endsection
