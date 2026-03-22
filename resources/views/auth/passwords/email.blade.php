@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:70vh">

        <div class="col-lg-5 col-md-7">

            <div class="card shadow-lg border-0">

                <div class="card-body p-4">

                    <!-- Título -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Redefinir senha</h2>
                        <p class="text-muted">
                            Insira seu e-mail para receber as instruções de recuperação.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        @include('layouts.messages')

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                E-mail
                            </label>

                            <input id="email"
                                   type="email"
                                   class="form-control form-control-md @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   placeholder="Digite seu e-mail">
                        </div>

                        
                        <!-- Confirme Email --> 
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Confirme E-mail
                            </label>

                            <input id="email-confirm"
                                   type="email"
                                   class="form-control form-control-md @error('email') is-invalid @enderror"
                                   name="email_confirmation"
                                   value="{{ old('email') }}"
                                   required                                   
                                   placeholder="Confirme seu e-mail">
                        </div>

                        <!-- Botão -->
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-dark btn-lg">
                                Enviar link de redefinição
                            </button>
                        </div>

                        <!-- registrar -->
                        @if (Route::has('register'))
                            <div class="text-center">

                                <span class="text-muted">
                                    Ainda não possui conta?
                                </span>

                                <a href="{{ route('register') }}"
                                   class="fw-semibold text-decoration-none ms-1">
                                    Criar conta
                                </a>

                            </div>
                        @endif

                        @if (Route::has('login'))
                            <div class="text-center">

                                <span class="text-muted">
                                    Já possui uma conta?
                                </span>

                                <a href="{{ route('login') }}"
                                   class="fw-semibold text-decoration-none ms-1">
                                    Entrar
                                </a>

                            </div>
                        @endif

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>


@endsection
