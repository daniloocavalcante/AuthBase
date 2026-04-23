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

                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        Cargos 
                    </li>

                    
                </ol>
            </nav>



            {{-- HEADER --}}
            <div class="mb-3">
                <h3 class="fw-bold mb-0">Cargos & Permissões</h3>
                <small class="text-muted">Gerencie funções, acessos e usuários do sistema</small>
            </div>

            {{-- MÉTRICAS --}}
            <div class="row mb-3 g-3">
                {{-- CARGOS --}}
                <div class="col-md-4">
                    <div class="card metric-card border-0 shadow-lg">
                        <div class="card-body d-flex align-items-center gap-3">

                            <div class="metric-icon bg-dark">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>

                            <div>
                                <small class="text-muted">Cargos</small>
                                <h4 class="fw-bold mb-0">{{ $roles->count() }}</h4>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- PERMISSÕES --}}
                <div class="col-md-4">
                    <div class="card metric-card border-0 shadow-lg">
                        <div class="card-body d-flex align-items-center gap-3">

                            <div class="metric-icon bg-primary">
                                <i class="fa-solid fa-key"></i>
                            </div>

                            <div>
                                <small class="text-muted">Permissões</small>
                                <h4 class="fw-bold mb-0">{{ $permissions->count() }}</h4>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- USUÁRIOS --}}
                <div class="col-md-4">
                    <div class="card metric-card border-0 shadow-lg">
                        <div class="card-body d-flex align-items-center gap-3">

                            <div class="metric-icon bg-success">
                                <i class="fa-solid fa-users"></i>
                            </div>

                            <div>
                                <small class="text-muted">Usuários</small>
                                <h4 class="fw-bold mb-0">{{ $totalUsers }}</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow mb-3 g-3 permission-card">

                {{-- HEADER --}}
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0 fw-semibold">Permissões</h6>
                        <small class="text-muted">Lista completa de permissões do sistema</small>
                    </div>

                    <span class="badge bg-dark">
                        {{ $permissions->count()}} Permissões
                    </span>
                </div>

                {{-- BODY --}}
                <div class="card-body">

                    @if($permissions->count())

                        <div class="row g-2">

                            @foreach($permissions as $permission)
                                <div class="col-md-4 col-sm-6">
                                    <div class="permission-item d-flex align-items-center justify-content-between">

                                        <div class="d-flex align-items-center gap-2" 
                                            style="min-width: 0;">
                                            <i class="fa-solid fa-key text-primary"></i>
                                            <span class="small fw-medium text-truncate"
                                                    title="{{ $permission->name }}">
                                                {{ $permission->name }}
                                            </span>
                                        </div>

                                        <span class="badge bg-light text-dark border small">
                                            ativo
                                        </span>

                                    </div>
                                </div>
                            @endforeach

                        </div>

                    @else
                        <div class="text-center py-4">
                            <i class="fa-solid fa-key fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Nenhuma permissão cadastrada</p>
                        </div>
                    @endif

                </div>

            </div>

            {{-- CARDS --}}
            <div class="row g-4">

                @foreach($roles as $role)
                <div class="col-lg-6">
                    <div class="card role-card border-0 shadow h-100">

                        <div class="card-body">

                            {{-- HEADER ROLE --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex align-items-center gap-2">
                                    <div class="role-icon">
                                        {{ strtoupper(substr($role->name, 0, 1)) }}
                                    </div>

                                    <h5 class="mb-0 fw-semibold">
                                        {{ ucfirst($role->name) }} 
                                    </h5>
                                </div>

                                <span class="badge bg-primary">
                                    {{ $role->users->count() }} usuários
                                </span>
                            </div>

                            {{-- PERMISSÕES --}}
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Permissões</small>

                                @if($role->permissions->count())
                                    <div class="d-flex flex-wrap gap-2">

                                        @foreach($role->permissions->take(8) as $permission)
                                            <span class="badge bg-light border text-dark">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach

                                        @if($role->permissions->count() > 8)
                                            <div class="badge bg-light border text-dark">
                                                +{{ $role->permissions->count() - 8 }}
                                            </div>
                                        @endif


                                    </div>
                                @else
                                    <span class="text-muted small">Sem permissões</span>
                                @endif
                            </div>

                            {{-- USUÁRIOS --}}
                            <div>
                                <small class="text-muted d-block mb-2">Usuários</small>

                                @if($role->users->count())
                                    <div class="d-flex align-items-center flex-wrap gap-2">

                                        @foreach($role->users as $index => $user)
                                            <a href="{{ route('users.show', $user->id) }}"
                                            class="user-chip text-decoration-none {{ $index >= 6 ? 'd-none extra-user' : '' }}"
                                            target="_blank"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{ $user->name }} {{ $user->surname }}">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </a>
                                        @endforeach

                                        @if($role->users->count() > 6)
                                            <a href="#"
                                            class="user-more text-decoration-none"
                                            onclick="toggleUsers(this); return false;"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Ver mais...">

                                                +{{ $role->users->count() - 6 }}

                                            </a>
                                        @endif

                                    </div>
                                @else
                                    <span class="text-muted small">Nenhum usuário</span>
                                @endif
                            </div>

                        </div>

                        {{-- FOOTER --}}
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">

                            <small class="text-muted">
                                Guard: {{ $role->guard_name }}
                            </small>

                            <a href="{{ route('roles.show', $role->id) }}" 
                            class="text-decoration-none fw-semibold small">
                                Gerenciar →
                            </a>

                        </div>

                    </div>
                </div>
                @endforeach

            </div>

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