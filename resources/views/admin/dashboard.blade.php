@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('System') }}
@endsection

@section('content')

<div class="container">

    <div class="row">

    <!-- COLUNA PRINCIPAL -->
    <div class="col-md-8 col-lg-9">
        
        <!-- BREADCRUMB -->
        <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-3">
            <ol class="breadcrumb mb-0 small">

                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="text-light text-decoration-none">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                    Painel Administrativo
                </li>
                
            </ol>
        </nav>

        <!-- KPIs -->
        <div class="row g-3">

            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h6 class="text-muted mb-1">
                                <i class="fa-solid fa-users me-1"></i> Usuários
                            </h6>
                            <h3 class="mb-0">{{ $totalUsers }}</h3>
                            <small class="{{ $percentChangeUsers > 0 ? 'text-success' : ($percentChangeUsers < 0 ? 'text-danger' : 'text-muted') }}">
                                {{ $percentChangeUsers > 0 
                                    ? '+' . $percentChangeUsers . '% hoje'
                                    : ($percentChangeUsers < 0 
                                        ? $percentChangeUsers . '% hoje' 
                                        : 'Estável') 
                                }}
                            </small>
                        </div>

                        <div class="text-primary fs-2">
                            <i class="fa-solid fa-user-group"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h6 class="text-muted mb-1">
                                <i class="fa-solid fa-file-lines me-1"></i> Logs
                            </h6>
                            <h3 class="mb-0">{{ $totalLogs }}</h3>
                            <small class="{{ $percentChangeLogs > 0 ? 'text-success' : ($percentChangeLogs < 0 ? 'text-danger' : 'text-muted') }}">
                                {{ $percentChangeLogs > 0 
                                    ? '+' . $percentChangeLogs . '% semana'
                                    : ($percentChangeLogs < 0 
                                        ? $percentChangeLogs . '% semana' 
                                        : 'Estável') 
                                }}
                            </small>
                        </div>

                        <div class="text-warning fs-2">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h6 class="text-muted mb-1">
                                <i class="fa-solid fa-shield-halved me-1"></i> Permissões
                            </h6>
                            <h3 class="mb-0">{{ $totalPermissions }}</h3>
                            <small class="text-primary">ativas</small>
                        </div>

                        <div class="text-success fs-2">
                            <i class="fa-solid fa-lock"></i>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- GRÁFICO FAKE / ATIVIDADE -->
        <div class="card shadow border-0 mt-4">
            <div class="card-body">

                <!-- 📊 Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Atividades (últimas 24h)</h6>
                    <small class="text-muted">Tempo real</small>
                </div>

                <!-- 📈 Gráfico -->
                <div style="" class="d-flex align-items-center justify-content-center">
                    <canvas id="logsChart" style="max-width: 100%;"
                        data-labels='@json($labels)'
                        data-data='@json($data)'>   
                    </canvas>
                </div>  

            </div>
        </div>
        
        

        <div class="row mt-4">

            <!-- 🟦 ATIVIDADES -->
            <div class="col-md-6">
                <div class="card shadow border-0">

                    <div class="card-body">

                        <h5 class="mb-3">Últimas {{ $logs->total() }} atividades...</h5>

                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Ação</th>
                                        <th class="text-end">Tempo</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>                                                
                                                @if($log->user)
                                                <a  href="{{ route('users.show', $log->user->id) }}" 
                                                    class="text-decoration-none text-dark" 
                                                    target="_blank"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Feito por: {{ $log->user->name ?? "Sistema" }}"
                                                    placeholder="Feito por: {{ $log->user->name ?? "Sistema" }}"                                                    
                                                    >                                                                                                     
                                                    <span class="fw-semibold">{{ $log->user->name }} </span>
                                                    <small class="text-muted ">
                                                        #{{ $log->user->id }}
                                                    </small>
                                                </a>
                                                @else
                                                <a  href="#" class="text-decoration-none text-muted"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Feito por: Sistema"
                                                    placeholder="Feito por: Sistema">
                                                    <span class="">{{ $log->model?->name ?? "Sistema"}}</span>
                                                    <small class="text-muted">
                                                        {{ $log->model_id ? "#". $log->model_id : "" }}                                                        
                                                    </small>
                                                </a>
                                                @endif
                                                

                                            </td>

                                            <td>
                                                
                                                <span class="badge {{ getLogBadge($log->action)['class'] ?? '' }} ">    
                                                    <i class="{{ getLogBadge($log->action)['icon'] }} me-1"></i>         
                                                    {{ getLogBadge($log->action)['text'] }}
                                                </span>
                                            </td>

                                            <td class="text-end text-muted">
                                                {{ $log->created_at->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <!-- 📌 PAGINAÇÃO -->
                        <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2">

                            <small class="text-muted">
                                Mostrando <strong>{{ $logs->firstItem() ?? 0 }}</strong>
                                -
                                <strong>{{ $logs->lastItem() ?? 0 }}</strong>
                                de
                                <strong>{{ $logs->total() }}</strong>
                            </small>

                            <div>
                                {{ $logs->links() }}
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <!-- 🟩 USUÁRIOS -->
            <div class="col-md-6">
                <div class="card shadow border-0">

                    <div class="card-body">

                        <h5 class="mb-3">Últimos {{ $users->total() }} usuários cadastrados...</h5>

                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th class="text-end">Criado</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <a href="{{ route('users.show', $user->id) }}" 
                                                    class="d-flex align-items-center text-decoration-none text-dark"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Acessar perfil de: {{ ucfirst($user->name) }}"
                                                    placeholder="title="Acessar perfil de: {{ ucfirst($user->name) }}" >
                                                    

                                                    <div class="me-2 text-secondary fs-5">
                                                        <i class="fa-solid fa-circle-user"></i>
                                                    </div>

                                                    
                                                    <div class="fw-semibold">
                                                        {{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}
                                                    </div>
                                                    
                                                </a>  
                                            </td>
                                            <td class="text-muted">{{ $user->email }}</td>
                                            <td class="text-end text-muted">
                                                {{ $user->created_at->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <!-- 📌 PAGINAÇÃO -->
                        <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2">

                            <small class="text-muted">
                                Mostrando <strong>{{ $users->firstItem() ?? 0 }}</strong>
                                -
                                <strong>{{ $users->lastItem() ?? 0 }}</strong>
                                de
                                <strong>{{ $users->total() }}</strong>
                            </small>

                            <div>
                                {{ $users->links() }}
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- COLUNA LATERAL -->
    <div class="col-md-4 col-lg-3">

        <!-- PERFIL ADMIN -->
        <div class="card shadow-lg border-0 text-center">
            <div class="card-body">

                <div class="mb-3">
                    <div class="rounded-circle {{ getUserBadge(auth()->user()?->getRoleNames()->first())['class'] ?? '' }} text-white d-flex align-items-center justify-content-center mx-auto"
                         style="width:60px;height:60px;">
                         {{ getUserBadge(auth()->user()?->getRoleNames()->first())['label'] ?? '' }}     
                    </div>
                </div>

                <h6 class="mb-0">{{ getUserBadge(auth()->user()?->getRoleNames()->first())['text'] ?? '' }}    </h6>
                <small class="text-muted">Online</small>

            </div>
        </div>

        <!-- ATALHOS -->
        <div class="card mt-3 shadow border-0">
            <div class="card-body">

                <h6 class="mb-3">Atalhos rápidos</h6>

                <a href="{{ route('users') }}" class="btn btn-primary btn-sm w-100 mb-2">Ver usuários</a>
                                <a href="{{ route('logs.download') }}" class="btn btn-outline-dark btn-sm w-100 mb-2">Baixar laravel.log</a>
                <a href="{{ route('logs') }}" class="btn btn-outline-secondary btn-sm w-100">Ver logs</a>


            </div>
        </div>

        <!-- STATUS SISTEMA -->
        <div class="card mt-3 shadow border-0">
            <div class="card-body">

                <h6>Status do sistema</h6>

                    <p class="mb-1">Banco de dados / Latência</p>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-success" style="width: {{ $databaseStatus }}%"></div>
                    </div>

                    <p class="mb-1">CPU / Carga do sistema</p>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-warning" style="width: {{ $cpuUsage }}%"></div>
                    </div>

                    <p class="mb-1">Memória / Uso do PHP</p>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: {{ $memoryPercent }}%"></div>
                    </div>

            </div>
        </div>

    </div>

</div>



 
</div>



@endsection