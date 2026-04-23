@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('System') }}
@endsection

@section('content')

<div class="container">

    <div class="row g-3">

        <!-- COLUNA PRINCIPAL -->
        <div class="col-md-8 col-lg-9 order-2 order-md-1"> 
            
            <!-- BREADCRUMB -->
            <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-3">
                <ol class="breadcrumb mb-0 small">

                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-light text-decoration-none">
                            Painel Administrativo
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('roles') }}" class="text-light text-decoration-none">
                            Cargos
                        </a>
                    </li>
                    

                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        {{ ucfirst($role->name) }} 
                    </li>

                    
                </ol>
            </nav>
            
            {{-- Mensagens do servidor --}}
            <x-alerts.messages /> 

            {{-- HEADER --}}


            <div class="container py-4">

                {{-- HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center gap-3">
                        <div class="role-icon-lg">
                            {{ strtoupper(substr($role->name, 0, 1)) }}
                        </div>

                        <div>
                            <h3 class="mb-0 fw-bold">
                                {{ ucfirst($role->name) }}
                            </h3>
                            <small class="text-muted">
                                Guard: {{ $role->guard_name }}
                            </small>
                        </div>
                    </div>

                    <span class="badge bg-primary px-3 py-2">
                        {{ $role->users->count() }} usuários
                    </span>

                </div>

                <div class="row g-4">

                    
                    <div class="col-md-6 g-3">
                        {{-- 👥 REMOVER USUÁRIOS --}}
                        <div class="card border-0 shadow">
                            
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-semibold mb-0">👥 Usuários no cargo</h6>
                                    <span class="badge bg-light text-dark">
                                        {{ $role->users->count() }}
                                    </span>
                                </div>


                                @forelse($users_paginate as $user_paginate)

                                    <div class="d-flex align-items-center justify-content-between mb-2 p-2 rounded bg-light">

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; font-size: 12px;">
                                                {{ strtoupper(substr($user_paginate->name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <div class="fw-semibold small">
                                                    {{ $user_paginate->name }} {{ $user_paginate->surname }}
                                                </div>
                                                <div class="text-muted small">
                                                    ID: #{{ $user_paginate->id }}
                                                </div>
                                            </div>

                                        </div>

                                        <form method="POST" action="{{ route('roles.remove', [$role->id, $user_paginate->id]) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Remover este usuário do cargo?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>

                                @empty
                                    <div class="text-center text-muted py-3">
                                        Nenhum usuário vinculado
                                    </div>
                                @endforelse

                                <div class="mt-3">
                                    {{ $users_paginate->links() }}
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 g-3">

                        {{-- 🔑 PERMISSÕES --}}
                        <div class="card border-0 shadow mb-3">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-semibold mb-0">🔑 Permissões</h6>
                                    <span class="badge bg-light text-dark">
                                        {{ $role->permissions->count() }}
                                    </span>
                                </div>

                                @if($role->permissions->count())
                                    <div class="d-flex flex-wrap gap-2">

                                        @foreach($role->permissions as $permission)
                                            <span class="badge bg-light border text-dark">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach

                                    </div>
                                @else
                                    <span class="text-muted small">Sem permissões</span>
                                @endif

                            </div>
                        </div>

                        {{-- 👥 ADICIONAR USUÁRIOS --}}
                        <div class="card border-0 shadow mb-3">
                            <div class="card-body">

                                <h6 class="fw-semibold mb-3">Adicionar usuário</h6>

                                <form method="POST" action="{{ route('roles.add', $role->id) }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label small">Usuário</label>

                                        <select name="user_id" class="form-select form-select-sm" required>
                                            <option value="">Selecione...</option>

                                            @foreach($users as $useroption)
                                                <option value="{{ $useroption->id }}">
                                                    {{ $useroption->name }} {{ $useroption->surname }} #{{$useroption->id}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary w-100">
                                        + Adicionar
                                    </button>
                                </form>

                            </div>
                        </div>
                        
                    </div>

                </div>

            </div>


<style>
    .role-icon-lg {
    width: 55px;
    height: 55px;
    border-radius: 16px;
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 20px;
}

.user-chip {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #eef2ff;
    color: #4f46e5;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    transition: 0.2s;
}

.user-chip:hover {
    background: #4f46e5;
    color: #fff;
}

.permission-item {
    background: #f9fafb;
    border-radius: 10px;
    padding: 6px 10px;
}
</style>

        </div>


        <!-- COLUNA LATERAL -->
        <div class="col-md-4 col-lg-3 order-1 order-md-2">

            <!-- PERFIL ADMIN -->
            <div class="card shadow-lg border-0 text-center">
                <div class="card-body">

                    <div class="mb-3">
                        <div class="rounded-circle {{ getUserBadge($profile?->getRoleNames()->first())->class ?? '' }} text-white d-flex align-items-center justify-content-center mx-auto"
                            style="width:60px;height:60px;">
                            {{ getUserBadge($profile?->getRoleNames()->first())->label ?? '' }}     
                        </div>
                    </div>
                    <h5 class="mb-1">{{ $profile->name . ' ' . $profile->surname }}</h5>

                    <h6 class="mb-0">{{ getUserBadge($profile?->getRoleNames()->first())->text ?? '' }}    </h6>
                    <small class="text-muted ">Online</small>

                </div>
            </div>

            <!-- ATALHOS -->
            <div class=" d-none d-md-block">
                <x-admin.quicks/>
            </div>

        </div>

    </div>
 
</div>



@endsection