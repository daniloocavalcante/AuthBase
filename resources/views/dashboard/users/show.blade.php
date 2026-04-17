@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Usuário') }}
@endsection

@section('content')
<div class="container">
    
    <div class="row justify-content-center g-3">
        <div class="col-lg-8 col-md-8">
            
            <!-- Breadcrumb de Navegação -->
            <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-2">
                <ol class="breadcrumb mb-0 small">

                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('users') }}" class="text-light text-decoration-none">
                            Usuários
                        </a>
                    </li>

                    <li class="breadcrumb-item active text-white opacity-75" aria-current="page">
                        {{ $user->name }} {{ $user->surname }}
                    </li>

                </ol>
            </nav>


            {{-- Mensagens do servidor --}}
            <x-alerts.messages />


            
            <div class="card shadow-lg border-0 printable">

                <!-- Header -->
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center">

                    <div class="me-3 text-primary fs-4">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div>
                        <h6 class="mb-0 fw-semibold">
                            Perfil do Usuário
                        </h6>

                        <small class="text-muted d-block">
                            {{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}
                        </small>

                    </div>
                </div>


            </div>

                <div class="card-body ">
                    

                    <div class="row justify-content-center">

                        <!-- Foto -->
                        <div class="col-md-4 text-center border-end">

                            <img src="{{ asset('images/default.png') }}?v=2"
                                class="img-fluid rounded-circle shadow mb-3"
                                style="width:120px;height:120px;object-fit:cover;">

                            <h5 class="mb-0">{{ $user->name }} {{ $user->surname }}</h5>

                            <!-- Badge -->                                                        
                            <div class="py-2">
                                    @php
                                        $role = $user->getRoleNames()->first();
                                        $badge = getUserBadge($role);
                                    @endphp
                                    <span class="badge {{ $badge['class'] }} fs-6 rounded-pill" >
                                        {{ $badge['text'] }}
                                    </span>
                            </div>

                            <small class="text-muted">
                                Usuário desde {{ $user->created_at->format('d/m/Y') }}
                            </small>

                        </div>

                        <!-- Dados -->
                        <div class="col-md-8">

                            <div class="row mb-3">                                
                                <label class="col-6 col-form-label text-muted">
                                    <i class="fa-solid fa-user me-1"></i>
                                    Nome
                                </label>
                                <div class="col-6 fw-semibold">{{ $user->name }}</div>
                            </div>

                            <div class="row mb-3">                                
                                <label class="col-6 col-form-label text-muted">
                                    <i class="fa-solid fa-user-tag me-1"></i>
                                    Sobrenome
                                </label>
                                <div class="col-6 fw-semibold">{{ $user->surname }}</div>
                            </div>


                            <div class="row mb-3">                                
                                <label class="col-6 col-form-label text-muted">
                                    <i class="fa-solid fa-calendar-days me-1"></i>
                                    Data de nascimento
                                </label>
                                <div class="col-6 fw-semibold">
                                    {{ $user->birth->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-6 col-form-label text-muted">
                                    <i class="fa-solid fa-venus-mars me-1"></i>
                                    Gênero
                                </label>
                                <div class="col-6 fw-semibold">{{ $user->gender_label }}</div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-6 col-form-label text-muted">
                                    <i class="fa-solid fa-history me-1"></i>
                                    Último login
                                </label>

                                <div class="col-6 fw-semibold">
                                    {{ $user->last_login?->diffForHumans() ?? 'Nunca acessou' }}
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Footer -->

                <div class="card-footer bg-light d-flex justify-content-end gap-2 flex-wrap">

                    <a href="{{ route('users') }}" class="btn btn-outline-primary btn-sm">
                        Tabela Usuários
                    </a>

                    <!-- Imprimir -->
                    <button onclick="window.print()" class="btn btn-sm btn-outline-dark">
                        <i class="fa-solid fa-print me-1"></i> Imprimir Perfil
                    </button>

                </div>


            </div>

        </div>

        <!-- Card guia rápido -->

        <div class="col-lg-4 col-md-4 d-print-none">
            <x-dashboard.quick-guide-card />
        </div>



        

    </div>
</div>

@endsection
