@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row g-3">
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

                <div class="d-flex align-items-center">

                    <div class="me-3 text-primary fs-2">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>

                    <div>
                        <h6 class="mb-0 fw-semibold fs-5">
                            Logs do Sistema
                        </h6>

                        <small class="text-muted d-block">
                            Gerenciamento de logs do sistema
                        </small>

                    </div>
                </div>


            </div>

                <div class="card-body pt-0">
                                    <!-- TOOLBAR -->
                <div class="d-flex justify-content-between align-items-center py-3" id="toolbar-users">

                    <!-- Botões -->
                    <div class="d-flex gap-2">

                        <!-- Exportar -->
                        <a class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exportCsvModal">
                            <i class="fa-solid fa-download me-1"></i> Exportar
                        </a>

                        <!-- Imprimir -->
                        <button onclick="window.print()" class="btn btn-sm btn-outline-dark">
                            <i class="fa-solid fa-print me-1"></i> Imprimir
                        </button>
                    </div>
                    
                    <!-- BUSCA -->
                    <form method="GET" class="d-flex m-2" style="flex:1; max-width:300px;">

                        <div class="input-group input-group w-100">

                            <!-- Ícone de lupa -->
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fa-solid fa-search text-muted"></i>
                            </span>

                            <!-- Input de busca -->
                            <input 
                                type="text"
                                name="search"
                                class="form-control border-start-0"
                                placeholder="Buscar por nome ou e-mail..."
                                value="{{ request('search') }}"
                            >

                            <!-- Botão limpar -->
                            <a href="{{ route('dashboard.users') }}" 
                            class="btn btn-outline-secondary"
                            style="border-top-left-radius:0; border-bottom-left-radius:0;">
                            <i class="fa-solid fa-xmark"></i>
                            </a>

                        </div>

                    </form>


                </div>



                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>
                                        <i class="fa-solid fa-calendar me-1 text-muted"></i>
                                        Gerado em
                                    </th>
                                    <th>
                                        <i class="fa-solid fa-user me-1 text-muted"></i>
                                        Usuário
                                    </th>
                                    <th class="d-print-none">
                                        <i class="fa-solid fa-bolt me-1 text-muted"></i>
                                        Action</th>
                                    <th>
                                        <i class="fa-solid fa-align-left me-1 text-muted"></i>
                                        Descrição
                                    </th>
                                    <th class="text-center d-print-none">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>             
                                        
                                        
                                        {{-- Data --}}
                                        <td>
                                            {{ $log->created_at->format('d/m/Y - H:i:s') }}                                           
                                        </td>


                                        {{-- Usuário --}}
                                        <td> 
                                            <span class="fw-semibold">{{ $log->user->name ?? 'Sistema' }}</span>
                                            <small class="text-muted ">
                                                #{{ $log->user_id ?? '-' }}
                                            </small>
                                        </td>

                                        {{-- Ação --}}
                                        <td class="d-print-none">
                                            <span class="badge {{ getLogBadge($log->action)['class'] }}"> 
                                                <i class="{{ getLogBadge($log->action)['icon'] }} me-1"></i>
                                                {{ getLogBadge($log->action)['text'] }}
                                            </span>
                                        </td>

                                        {{-- Descrição --}}
                                        <td>
                                            <div class="text-truncate" style="max-width: 300px;" title="{{ $log->description }}">
                                                {{ $log->description }}
                                            </div>
                                        </td>


                                        {{-- Ação (ver detalhes) --}}
                                        <td class="text-center d-print-none">
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
                    <div class="d-flex justify-content-between align-items-center mt-3">

                        <small class="text-muted">
                            Mostrando {{ $logs->firstItem() }} até {{ $logs->lastItem() }}
                            de {{ $totalLogs }} logs
                        </small>


                        {{ $logs->links() }}
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3">

            {{-- 🔹 CARD RESUMO --}}

            <div class="card shadow-lg border-0 mb-3">
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5 fw-semibold">📊 Resumo do Sistema</span>
                </div>
                <div class="card-body d-flex justify-content-around text-center py-3 fs-5">

                    <div>
                        <small class="text-muted">Total</small>
                        <div class="fw-bold">{{ $totalLogs }}</div>
                    </div>

                    <div>
                        <small class="text-muted">Hoje</small>
                        <div class="fw-bold">{{ $logsHoje }}</div>
                    </div>

                    <div>
                        <small class="text-muted">Erros</small>
                        <div class="fw-bold text-danger">{{ $logsErro }}</div>
                    </div>

                </div>
            </div>

            {{-- 🔹 CARD ATIVIDADES --}}
            <div class="card shadow-lg border-0 mb-3">        
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    
                    <span class="fs-5"><i class="fa-solid fa-clock-rotate-left"></i> Atividades Recentes</span>
                </div>
                
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($recentLogs as $log)
                            @php
                                $badge = getLogBadge($log->action);
                            @endphp

                            <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                
                                <div>
                                    <strong class="me-2">
                                        {{ $log->user->name ?? 'Sistema' }}
                                    </strong>

                                    <span class="badge {{ $badge['class'] }}">

                                        {{ $badge['text'] }}
                                    </span>
                                </div>

                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $log->created_at->diffForHumans() }}
                                </small>

                            </li>
                        @endforeach

                        <li class="list-group-item text-center text-muted small">
                            Exibindo as 5 atividades mais recentes
                        </li>
                    </ul>
                </div>
            </div>
            
            <x-dashboard.quick-guide-card /> 
        </div>
    </div>    
</div>




<!-- Modal de confirmação -->
<div class="modal fade" id="exportCsvModal" tabindex="-1" aria-labelledby="exportCsvModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exportCsvModalLabel">Confirmar Exportação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <div class="modal-body">
        Tem certeza de que deseja exportar os registros de logs para um arquivo CSV?
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="{{ route('dashboard.logs.export') }}" id="confirmExportBtn"  class="btn btn-primary">Confirmar Exportar</a>
      </div>

    </div>
  </div>
</div>




@endsection