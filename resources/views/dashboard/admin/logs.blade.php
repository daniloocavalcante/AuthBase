@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-3">
                <ol class="breadcrumb mb-0 small">

                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="#" class="text-light text-decoration-none">
                            Administração
                        </a>
                    </li>

                    <li class="breadcrumb-item activeopacity-75" aria-current="page">
                        <a href="#" class="text-light text-decoration-none">
                            Logs
                        </a>
                    </li>
                    
                </ol>
            </nav>

            <div class="card shadow-lg border-0 printable">

                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h2 class="mb-4">
                    <i class="fa-solid fa-file-lines"></i> Logs do Sistema
                </h2>
                
                </div>

                <div class="card-body pt-0">
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 50px;">#</th>
                <th>Usuário</th>
                <th>Ação</th>
                <th style="max-width: 250px;">Descrição</th>
                <th style="width: 140px;">Data</th>
                <th style="width: 80px;" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>

                    {{-- ID --}}
                    <td>{{ $log->id }}</td>

                    {{-- Usuário --}}
                    <td>
                        <div class="fw-semibold">
                            {{ $log->user->name ?? 'Sistema' }}
                        </div>
                        <small class="text-muted">
                            #{{ $log->user_id ?? '-' }}
                        </small>
                    </td>

                    {{-- Ação --}}
                    <td>
                        <span class="badge 
                            @if($log->action == 'login') bg-primary
                            @elseif($log->action == 'logout') bg-secondary
                            @elseif($log->action == 'error') bg-danger
                            @else bg-dark
                            @endif">
                            {{ ucfirst($log->action) }}
                        </span>
                    </td>

                    {{-- Descrição --}}
                    <td>
                        <div class="text-truncate" style="max-width: 250px;" title="{{ $log->description }}">
                            {{ $log->description }}
                        </div>
                    </td>

                    {{-- Data --}}
                    <td>
                        <div>{{ $log->created_at->format('d/m/Y') }}</div>
                        <small class="text-muted">
                            {{ $log->created_at->format('H:i') }}
                        </small>
                    </td>

                    {{-- Ação (ver detalhes) --}}
                    <td class="text-center">
                        <a href="#"
                           class="btn btn-sm btn-outline-dark"
                           title="Ver detalhes">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Paginação --}}
<div class="mt-3">
    {{ $logs->links() }}
</div>
                </div>
            </div>

        </div>

        <div class="col-md-3">

            {{-- 🔹 CARD RESUMO --}}
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Resumo do Sistema</span>
                </div>
                <div class="card-body">        

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-muted">Total de Logs</small>
                            <h4 class="mb-0 fw-bold">{{ $totalLogs }}</h4>
                        </div>
                        <i class="bi bi-list-ul fs-3 text-primary"></i>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-muted">Hoje</small>
                            <h4 class="mb-0 fw-bold">{{ $logsHoje }}</h4>
                        </div>
                        <i class="bi bi-calendar-day fs-3 text-success"></i>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Erros</small>
                            <h4 class="mb-0 fw-bold text-danger">{{ $logsErro }}</h4>
                        </div>
                        <i class="bi bi-exclamation-triangle fs-3 text-danger"></i>
                    </div>
                </div>
            </div>

            {{-- 🔹 CARD ATIVIDADES --}}
            <div class="card shadow-lg border-0">        
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Atividades Recentes</span>
                </div>
                
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($recentLogs as $log)
                            <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                
                                <div>
                                    <strong>{{ $log->user->name ?? 'Sistema' }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $log->action }}</small>
                                </div>

                                <small class="text-muted">
                                    {{ $log->created_at->diffForHumans() }}
                                </small>

                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

        </div>
    </div>

    
</div>
@endsection