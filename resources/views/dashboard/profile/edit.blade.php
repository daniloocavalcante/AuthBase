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

                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.profile') }}" class="text-light text-decoration-none">
                            Meu Perfil
                        </a>
                    </li>

                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        Editar Perfil
                    </li>

                </ol>
            </nav>
            

            {{-- Mensagens do servidor --}}
            <x-alerts.messages />


            <div class="card shadow-lg border-0">

                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Editar Perfil</span>
                </div>

                <form action="{{ route('dashboard.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')                    

                    <div class="card-body">

                        <div class="row justify-content-center">

                            <!-- Foto -->
                            <div class="col-md-4 text-center border-end">

                                <img src="{{ asset('storage/photos_users/default.png') }}?v=2"
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
                                    <div class="col-7">
                                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-user-tag me-1"></i>
                                        Sobrenome
                                    </label>
                                    <div class="col-7">
                                        <input type="text" name="surname" class="form-control form-control-sm" value="{{ $user->surname }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-envelope me-1"></i>
                                        E-mail
                                    </label>
                                    <div class="col-7">
                                        <input type="email" name="email" class="form-control form-control-sm" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-envelope me-1"></i>
                                        Confirmar E-mail
                                    </label>
                                    <div class="col-7">
                                        <input type="email" name="email_confirmation" class="form-control form-control-sm" placeholder="Digite novamente seu e-mail">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-calendar-days me-1"></i>
                                        Data de nascimento
                                    </label>
                                    <div class="col-7">
                                        <input type="date" name="birth" class="form-control form-control-sm" value="{{ $user->birth->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-venus-mars me-1"></i>
                                        Gênero
                                    </label>
                                    <div class="col-7">
                                        <select name="gender" class="form-select form-select-sm">
                                            <option value="Masculino" {{ $user->gender == 'Masculino' ? 'selected' : '' }}>
                                                Masculino
                                            </option>
                                            <option value="Feminino" {{ $user->gender == 'Feminino' ? 'selected' : '' }}>
                                                Feminino
                                            </option>
                                            <option value="Outro" {{ $user->gender == 'Outro' ? 'selected' : '' }}>
                                                Outro
                                            </option>
                                        </select>
                                    </div>
                                </div>
                           
                            </div>

                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-light d-flex justify-content-end gap-2 flex-wrap">

                        
                        <a href="{{ route('dashboard.profile') }}" class="btn btn-outline-dark btn-sm me-auto">
                            Voltar
                        </a>

                        <a href="{{ route('dashboard.password.edit') }}" class="btn btn-outline-primary btn-sm">
                            Alterar Senha
                        </a>


                        <button type="submit" class="btn btn-success btn-sm">
                            Salvar Alterações
                        </button>

                    </div>
                </form>

            </div>

        </div>

        <!-- Card guia rápido -->

        <div class="col-lg-4 col-md-5">
            <x-dashboard.quick-guide-card /> 
        </div>

    </div>
</div>



@endsection
