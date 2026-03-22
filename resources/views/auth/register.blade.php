@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Register') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:70vh">

        <div class="col-lg-6 col-md-6">

            <div class="card shadow-lg border-0">

                <div class="card-body p-4">

                    <!-- Título -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Cadastro</h2>
                        <p class="text-muted">
                            Preencha os dados abaixo para criar sua conta
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        @include('layouts.messages')

                        <!-- Nome / Sobrenome -->
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nome</label>

                                <input
                                    class="form-control form-control-md"
                                    type="text"
                                    name="name"
                                    required
                                    placeholder="Digite seu nome"
                                    value="{{ old('name') }}"
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Sobrenome</label>

                                <input
                                    class="form-control form-control-md"
                                    type="text"
                                    name="surname"
                                    required
                                    placeholder="Digite seu sobrenome"
                                    value="{{ old('surname') }}"
                                >
                            </div>

                        </div>

                        <!-- Data / Gênero -->
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Data de nascimento</label>

                                <input
                                    id="birth"
                                    type="date"
                                    class="form-control form-control-md"
                                    name="birth"
                                    value="{{ old('birth') }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Gênero</label>

                                <select class="form-select form-select-md" name="gender">

                                    <option value="1" {{ old('gender')=="1" ? "selected" : "" }}>
                                        Masculino
                                    </option>

                                    <option value="2" {{ old('gender')=="2" ? "selected" : "" }}>
                                        Feminino
                                    </option>

                                    <option value="3" {{ old('gender')=="3" ? "selected" : "" }}>
                                        Prefiro não informar
                                    </option>

                                </select>
                            </div>

                        </div>

                        <!-- Email -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">E-mail</label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>

                                <input
                                    id="email"
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    placeholder="Digite seu e-mail"
                                    value="{{ old('email') }}"
                                    required>

                            </div>

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
 

                        <!-- Botões -->
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <button class="btn btn-outline-secondary px-4" type="reset">
                                Limpar
                            </button>

                            <button class="btn btn-dark btn-md px-5" type="submit">
                                Registrar-se
                            </button>

                        </div>

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
