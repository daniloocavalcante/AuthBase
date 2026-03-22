@extends('layouts.app')

@section('content')
<div class="container d-flex  justify-content-center" style="min-height: 90vh;">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow border-0 rounded-4">

            <div class="card-body text-center p-5">

                <!-- Ícone -->
                <div class="mb-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-envelope-check fs-1 text-primary"></i>
                    </div>
                </div>

                <!-- Título -->
                <h3 class="fw-bold mb-2">
                    Verifique seu e-mail
                </h3>

                <!-- Subtítulo -->
                <p class="text-muted mb-4">
                    Enviamos um link de confirmação para o seu e-mail.  
                    Clique nele para ativar sua conta.
                </p>

                <!-- Sucesso -->
                @if (session('resent'))
                    <div class="alert alert-success">
                        ✅ Um novo link foi enviado para seu e-mail!
                    </div>
                @endif

                <!-- Botão -->
                <form method="POST" action="{{ route('verification.resend') }}" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Reenviar e-mail
                    </button>
                </form>

                <!-- Dicas -->
                <div class="text-muted small">
                    <p class="mb-1">📌 Verifique também sua caixa de spam</p>
                    <p class="mb-0">📧 Pode levar alguns segundos para chegar</p>
                </div>

                <!-- Logout opcional -->
                <div class="mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-link text-decoration-none text-muted">
                            Trocar de conta
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
