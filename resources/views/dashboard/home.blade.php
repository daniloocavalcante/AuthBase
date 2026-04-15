@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Home') }}
@endsection

@section('content')
<div class="container">

    <div class="row g-4">

        <!-- Área principal -->
        <div class="col-lg-8 col-md-8">

            {{-- Mensagens do servidor --}}
            <x-alerts.messages />        

            <!-- Card de boas-vindas / resumo -->
            <div class="card shadow-lg border-0 rounded-4 mb-4 text-center overflow-hidden">
                <div class="card-header bg-gradient fs-5 text-dark fw-bold py-3" style="background: linear-gradient(135deg, #4e73df, #1cc88a);">
                    🎉 Bem-vindo ao seu Dashboard
                </div>
                <div class="card-body py-4">
                    <h4 class="card-title mb-2">Olá, <strong>{{ ucfirst(Auth::user()->name) }} {{ ucfirst(Auth::user()->surname) }}</strong>!</h4>
                    <p class="card-text text-muted mb-4">
                        Gerencie seu perfil, atualize sua senha e explore a tabela de usuários.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('profile.edit') }}" class="btn btn-success fw-bold shadow-sm">
                            <i class="fa-solid fa-user me-2"></i> Editar perfil
                        </a>
                        <a href="{{ route('users') }}" class="btn btn-info text-white fw-bold shadow-sm">
                            <i class="fa-solid fa-table me-2"></i> Tabela de usuários
                        </a>
                    </div>
                </div>
                <div class="card-footer text-muted bg-white border-0">
                    Último login: {{ $user->last_login?->diffForHumans() ?? 'Agora há pouco' }}
                </div>
            </div>

            <!-- Card de dicas rápidas -->
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-header bg-dark text-white fw-bold py-3">
                    💡 Dicas rápidas
                </div>
                <div class="card-body py-3">
                    <ul class="list-unstyled mb-0 text-start">
                        <li class="mb-2">
                            <span class="badge bg-success me-2"><i class="fa-solid fa-check"></i></span>
                            Mantenha sua senha atualizada
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-success me-2"><i class="fa-solid fa-check"></i></span>
                            Explore a tabela de usuários para testes
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-success me-2"><i class="fa-solid fa-check"></i></span>
                            Use os atalhos do guia rápido para navegar mais rápido
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Coluna lateral / guia rápido -->
        <div class="col-lg-4 col-md-4">
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
