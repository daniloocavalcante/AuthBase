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
            <x-alerts.messages />
            
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

                            <img src="{{ asset('images/default.png') }}?v=2"
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
                                        data-bs-title="E-mail verificado"></i>
                                    @else
                                        <i class="fa-regular fa-circle-check text-secondary ms-2"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="E-mail não verificado"></i>
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
                    <a href="{{ route('dashboard.email.edit') }}" class="btn btn-outline-secondary btn-sm">
                            Alterar E-mail
                    </a> 
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
            <x-dashboard.quick-guide-card /> 
        </div>        

    </div>
</div>


<!-- Modal de confirmação -->

<div class="modal fade" id="verifyEmail" tabindex="-1" aria-labelledby="verifyEmailLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">

      <!-- HEADER -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title d-flex align-items-center gap-2" id="verifyEmailLabel">
          <i class="fa-solid fa-envelope-circle-check"></i>
          Verifique seu e-mail
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body text-center py-4">

        @if (session('resent'))

            <div class="mb-3">
                <i class="fa-solid fa-circle-check text-success fs-2"></i>
            </div>

            <p class="fw-semibold mb-1 text-success">
                Link reenviado com sucesso
            </p>

            <p class="text-muted small mb-0">
                Enviamos um novo link de verificação para o seu e-mail.
                Verifique sua caixa de entrada para continuar.
            </p>

        @else

            <div class="mb-3">
                <i class="fa-solid fa-envelope-open-text text-primary fs-2"></i>
            </div>

            <p class="fw-semibold mb-1">
                Confirme seu e-mail
            </p>

            <p class="text-muted small mb-0">
                Enviamos um link de verificação quando você se cadastrou.
                Acesse sua caixa de entrada e clique no link para ativar sua conta.
            </p>

        @endif

      </div>

      <!-- FOOTER -->
      <div class="modal-footer justify-content-center border-0 pb-4">
        @if (!session('resent'))

            <form method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit" class="btn btn-outline-primary btn-sm">
                <i class="fa-solid fa-paper-plane me-1"></i>
                Reenviar e-mail
              </button>
            </form>        

        @endif

        <button type="button" class="btn btn-sm btn-outline-dark" data-bs-dismiss="modal">
          Fechar
        </button>
      </div>

    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const resent = "{{ session('resent') }}";

        if (resent) {
            const modal = new bootstrap.Modal(document.getElementById('verifyEmail'));
            modal.show();
        }
    });
</script>
@endsection
