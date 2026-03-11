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
                        Editar Perfil
                    </li>

                </ol>
            </nav>

            <div class="card shadow-lg border-0">

                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Editar Perfil</span>
                    <span class="badge bg-primary">{{ $user->privilege }}</span>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                                    <div class="col-7">
                                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-user-tag me-1"></i>
                                        Sobrenome
                                    </label>
                                    <div class="col-7">
                                        <input type="text" name="surname" class="form-control form-control-sm" value="{{ $user->surname }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-envelope me-1"></i>
                                        E-mail
                                    </label>
                                    <div class="col-7">
                                        <input type="email" name="email" class="form-control form-control-sm" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-envelope me-1"></i>
                                        Confirmar E-mail
                                    </label>
                                    <div class="col-7">
                                        <input type="email" name="email_confirmation" class="form-control form-control-sm" placeholder="Digite novamente seu e-mail">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-calendar-days me-1"></i>
                                        Data de nascimento
                                    </label>
                                    <div class="col-7">
                                        <input type="date" name="birth" class="form-control form-control-sm" value="{{ $user->birth->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-venus-mars me-1"></i>
                                        Gênero
                                    </label>
                                    <div class="col-7">
                                        <select name="gender" class="form-select form-select-sm">
                                            <option value="Masculino" {{ $user->gender == 'Masculino' ? 'selected' : '' }}>
                                                Masculino
                                            </option>
                                            <option value="Feminino" {{ $user->gender == 'Feminino' ? 'selected' : '' }}>
                                                Feminino
                                            </option>
                                            <option value="Outro" {{ $user->gender == 'Outro' ? 'selected' : '' }}>
                                                Outro
                                            </option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-light d-flex justify-content-end gap-2 flex-wrap">

                        
                        <a href="{{ route('profile') }}" class="btn btn-outline-dark btn-sm">
                            Voltar
                        </a>

                        <a href="{{ route('dashboard.change-password') }}" class="btn btn-outline-primary btn-sm">
                            Alterar Senha
                        </a>


                        <button type="submit" class="btn btn-success btn-sm">
                            Salvar Alterações
                        </button>

                    </div>
                </form>

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
