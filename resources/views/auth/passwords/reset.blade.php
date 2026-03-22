@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:70vh">

        <div class="col-lg-5 col-md-7">

            <div class="card shadow-lg border-0">

                <div class="card-body p-4">

                    <!-- Título -->
                    <div class="text-center mb-3">
                        <h2 class="fw-bold">Redefinir senha</h2>
                        <p class="text-muted">
                            Crie uma nova senha para sua conta.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        @include('layouts.messages')

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                E-mail
                            </label>

                            <input id="email"
                                   type="email"
                                   class="form-control form-control-md @error('email') is-invalid @enderror text-muted"
                                   name="email"
                                   value="{{ $email ?? old('email') }}"
                                   readonly
                                   placeholder="Digite seu e-mail">
                        </div>

                        <!-- Senhas -->
                        <div class="row mb-3">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">Senha</label>

                                <div class="input-group">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="Digite sua senha"
                                        autofocus
                                        required>

                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="eyeButton"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Mostrar senha"
                                            aria-label="Mostrar senha">
                                        <i id="eyeIcon" class="fa-solid fa-eye"></i>

                                    </button>
                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">Confirmar senha</label>

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
                                            title="Mostrar senha"
                                            aria-label="Mostrar senha">
                                        <i id="eyeIconConfirmation" class="fa-solid fa-eye"></i>

                                    </button>
                                </div>

                            </div>

                        </div>
                        
                        


                        <!-- Botão -->
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-dark">
                                Salvar nova senha
                            </button>
                        </div>

                        <!-- login -->
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
