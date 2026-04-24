@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Reset Password') }}
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
                        <a href="{{ route('profile') }}" class="text-light text-decoration-none">
                            Meu Perfil
                        </a>
                    </li>                 
                    
                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        Alterar Senha
                    </li>

                </ol>
            </nav>

            {{-- Mensagens do servidor --}}
            <x-alerts.messages />

            <div class="card shadow-lg border-0">
                
                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Alterar Senha</span>
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
                                            tabindex="-1"
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
                                        placeholder="Digite sua nova senha"
                                        required>

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="eyeButton"
                                            tabindex="-1"
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
                                        placeholder="Repita sua nova senha"
                                        required>

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            tabindex="-1"
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
                            <a href="{{ route('profile') }}" tabindex="-1" class="btn btn-primary btn-sm ">
                                Meu Perfil
                            </a>  
                        </div>

 
                        <a href="#" tabindex="-1" class="btn btn-outline-danger btn-sm " data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            Excluir Conta
                        </a> 
                        <a href="{{ route('email.edit') }}" tabindex="-1" class="btn btn-outline-secondary btn-sm">
                            Alterar E-mail
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
