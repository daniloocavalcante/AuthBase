@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Home') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center g-3">
        <div class="col-md-7">

            {{-- Mensagens do servidor --}}
            <x-alerts.messages />        

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
