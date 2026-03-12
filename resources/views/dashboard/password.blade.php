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
                        <a href="{{ route('dashboard.index') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.profile') }}" class="text-light text-decoration-none">
                            Meu Perfil
                        </a>
                    </li>                 
                    
                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        Alterar Senha
                    </li>

                </ol>
            </nav>

{{-- Mensagens do servidor --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0">
                
                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Alterar Senha</span>
                </div>

                <form action="{{ route('dashboard.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="row mb-3">

                            <label class="col-5 col-form-label text-muted">
                                <i class="fa-solid fa-lock me-1"></i>
                                Senha Atual
                            </label>
                            <div class="col-7">

                                <div class="input-group">
                                    <input
                                        id="current_password"
                                        type="password"
                                        class="form-control"
                                        name="current_password"
                                        placeholder="Digite sua senha"
                                        required>

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="eyeButtonCurrent"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Mostrar/Esconder"
                                            aria-label="Mostrar/Esconder">
                                        <i id="eyeIconCurrent" class="fa-solid fa-eye"></i>

                                    </button>
                                </div>

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
                    <div class="card-footer bg-light d-flex align-items-center flex-wrap gap-2">
                        
                        <div class="me-auto">
                            <a href="{{ route('dashboard.profile') }}" class="btn btn-outline-dark btn-sm me-auto">
                                Voltar
                            </a>
                        </div>

                        <a href="#" class="btn btn-outline-danger btn-sm " data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            Excluir Conta
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

        <form action="{{ route('dashboard.profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir Conta</button>
        </form>
      </div>

    </div>
  </div>
</div>



@endsection
