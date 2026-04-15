@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('E-mail') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center g-4">

        <div class="col-lg-8 col-md-7">

            <!-- Breadcrumb de Navegação -->
            <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-2">
                <ol class="breadcrumb mb-0 small">

                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a tabindex="-1" href="{{ route('profile') }}" class="text-light text-decoration-none">
                            Meu Perfil
                        </a>
                    </li>                 
                    
                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        Alterar E-mail
                    </li>

                </ol>
            </nav>

            {{-- Mensagens do servidor --}}
            <x-alerts.messages />

            <div class="card shadow-lg border-0">
                
                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Alterar E-mail</span>
                </div>

                <form action="{{ route('email.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="row mb-3">

                            <label class="col-5 col-form-label text-muted">
                                <i class="fa-solid fa-envelope me-1"></i>
                                E-mail Atual
                            </label>
                            <div class="col-7">

                                <div class="input-group">
                                    <input
                                        id="current_email"
                                        type="email"
                                        class="form-control"                                        
                                        value="{{$user->email}}"
                                        required disabled>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-5 col-form-label text-muted">
                                <i class="fa-solid fa-envelope  me-1"></i>
                                Novo E-mail
                            </label>
                            <div class="col-7">

                                <div class="input-group">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        placeholder="Digite seu novo e-mail"                                        
                                        required>

                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-5 col-form-label text-muted">
                                <i class="fa-solid fa-envelope me-1"></i>
                                Confirmar Novo E-mail
                            </label>    
                            <div class="col-7">
                                
                                <div class="input-group">
                                    <input                                        
                                        type="email"
                                        class="form-control"
                                        name="email_confirmation"
                                        placeholder="Repita seu e-mail"
                                        required>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-5 col-form-label text-muted">
                                <i class="fa-solid fa-lock me-1"></i>
                                Informar Senha
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
                                            tabindex="-1"
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

                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-light d-flex align-items-center flex-wrap gap-2">
                        
                        <div class="me-auto">
                            <a tabindex="-1" href="{{ route('profile') }}" class="btn btn-outline-primary btn-sm me-auto">
                                Meu Perfil
                            </a>
                        </div>
                        
                        <a tabindex="-1" href="{{ route('password.edit') }}" class="btn btn-outline-dark btn-sm">
                            Alterar Senha
                        </a>
          

                        <button type="submit" class="btn btn-success btn-sm">
                            Alterar E-mail
                        </button>

                    </div>

                </form>
            </div>


            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-dark text-white">
                    <i class="fa-solid fa-envelope me-2"></i> Dicas para E-mail
                </div>
                <div class="card-body bg-white small">
                    <ul class="mb-0 ps-3">
                        <li>Use um endereço de e-mail <strong>válido e ativo</strong>.</li>
                        <li>Evite endereços muito genéricos ou fáceis de adivinhar.</li>
                        <li>Não compartilhe sua senha de e-mail com terceiros.</li>
                        <li>Use e-mails diferentes para contas pessoais e serviços públicos.</li>
                        <li>Mantenha seu provedor de e-mail atualizado e seguro.</li>
                    </ul>
                </div>
            </div>




        </div>

        <!-- Card guia rápido -->

        <div class="col-lg-4 col-md-5">
            <x-dashboard.quick-guide-card /> 
        </div>



    </div>
</div>


<!-- Modal de confirmação: Exclusão de Conta -->

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
