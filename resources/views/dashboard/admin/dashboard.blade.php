@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('System') }}
@endsection

@section('content')

<div class="container">
    <div class="row g-3">
        <div class="col-md-9">
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-3">
                <ol class="breadcrumb mb-0 small">

                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="#" class="text-light text-decoration-none">
                            Administração
                        </a>
                    </li>

                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        Painel Administrativo
                    </li>
                    
                </ol>
            </nav>

        </div>

        <div class="col-md-3">           

            <x-dashboard.quick-guide-card /> 

        </div>
    </div>    
</div>




<!-- Modal de confirmação -->


@endsection