@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Verify Email Address') }}
@endsection

@section('content')


<!-- E-mail verificado -->

<div class="container d-flex align-items-center justify-content-center p-5">
    
    <div class="col-md-7 col-lg-6">
        <div class="card shadow border-0 rounded-4 text-center">

            <div class="card-body text-center p-5">
                <!-- Ícone -->
                <div class="mb-3">
                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                </div>

                <!-- Título -->
                <h2 class="fw-bold text-success mb-2">
                    Conta verificada com sucesso!
                </h2>

                <!-- Subtítulo -->
                <p class="text-muted mb-4">
                    Seu e-mail foi confirmado. Agora você já pode acessar sua conta normalmente.
                </p>              

                <!-- Botão -->
                @guest
                <a href="{{ route('login') }}" class="btn btn-success px-4 py-2">
                    <i class="fa-solid fa-lock me-2"></i>
                    Ir para o login
                </a>      
                @endguest

                @auth
                
                <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2">
                    <i class="fa-solid fa-gauge me-2"></i>
                    Início
                </a>  

                <a href="{{ route('profile') }}" class="btn btn-success px-4 py-2">
                    <i class="fa-solid fa-user me-2"></i>
                    Meu Perfil
                </a>      

                @endauth            

            </div>
        </div>
    </div>
</div>

@endsection
