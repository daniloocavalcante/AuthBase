@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Login') }}
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:70vh">

        <div class="col-lg-4 col-md-5">

            <div class="card shadow-lg border-0">

                <div class="card-body p-4">

                    <!-- Título -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Entrar no Sistema</h2>
                        <p class="text-muted">
                            Acesse sua conta para continuar
                        </p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @include('layouts.validations-forms')

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

                        <!-- Senha -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Senha
                            </label>

                                <div class="input-group">

                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="Digite sua senha"
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

                        <!-- lembrar -->
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="remember"
                                       id="remember"
                                       {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Manter-me conectado
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-decoration-none small">
                                    Esqueci minha senha
                                </a>
                            @endif

                        </div>

                        <!-- Botão -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-dark btn-lg">
                                Entrar
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

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>
    

@endsection
