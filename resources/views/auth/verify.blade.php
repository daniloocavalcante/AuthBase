@extends('layouts.app')

@section('content')

<div class="container d-flex align-items-center justify-content-center p-5">
    
    <div class="col-md-7 col-lg-6">
        <div class="card shadow border-0 rounded-4 text-center">

            <div class="card-body text-center p-5">
                <!-- Ícone -->
                <div class="mb-3">
                    <i class="fas fa-envelope-open-text text-primary" style="font-size: 4rem;"></i>
                </div>

                <!-- Título -->
                <h2 class="fw-bold text-primary mb-2">
                    Verifique sua conta
                </h2>

                <!-- Subtítulo -->
                <p class="text-muted mb-4">
                    Enviamos um link de verificação para o seu e-mail. 
                    Por favor, acesse sua caixa de entrada e clique no link para ativar sua conta.
                </p>

                <!-- Alerta de reenvio -->
                @if (session('resent'))
                    <div class="alert alert-success mb-4" role="alert">
                        Um novo link de verificação foi enviado para o seu e-mail.
                    </div>
                @endif

                <!-- Botão reenviar -->
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary px-4 py-2">
                        Reenviar e-mail
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection