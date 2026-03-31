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

                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        Logs
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
                <div class="d-flex justify-content-between align-items-center py-3 d-print-none" id="toolbar-users">

                    <!-- Botões -->
                    <div class="d-flex gap-2">

                        <!-- Exportar -->
                        <a class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exportCsvModal">
                            <i class="fa-solid fa-download me-1"></i> Exportar
                        </a>

                        <!-- Imprimir -->
                        <button id="btn-print" class="btn btn-sm btn-outline-dark">
                            <i class="fa-solid fa-print me-1"></i> Imprimir
                        </button>
                    </div>
                    
                    <!-- BUSCA -->
                    <form method="GET" class="d-flex m-2" style="flex:1; max-width:350px;">

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
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Buscar por nome, ação ou descrição..."
                                placeholder="Buscar por nome, ação ou descrição..."
                                value="{{ request('search') }}"
                            >

                            <!-- Botão limpar -->
                            <a href="{{ route('dashboard.logs') }}" 
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
                                        <a href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'created_at',
                                            'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                            'page' => null,
                                        ]) }}" class="text-dark text-decoration-none d-flex align-items-center">

                                            <i class="fa-solid fa-calendar me-1 text-muted"></i>
                                            <span class="me-1">Gerado em</span>

                                            <span class="sort-icons ms-1">
                                                <span class="sort-up {{ request('sort') == 'created_at' && request('direction') == 'asc' ? 'active' : '' }}">▲</span>
                                                <span class="sort-down {{ request('sort') == 'created_at' && request('direction') == 'desc' ? 'active' : '' }}">▼</span>
                                            </span>
                                            
                                        </a>
                                    </th>


                                    <th>
                                        <i class="fa-solid fa-user me-1 text-muted"></i>
                                        Usuário
                                    </th>

                                    <th class="d-print-none">
                                        <a href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'action',
                                            'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                            'page' => null,
                                        ]) }}" class="text-dark text-decoration-none d-flex align-items-center">

                                            <i class="fa-solid fa-bolt me-1 text-muted"></i>
                                            <span class="me-1">Action</span>

                                            <span class="sort-icons ms-1">
                                                <span class="sort-up {{ request('sort') == 'action' && request('direction') == 'asc' ? 'active' : '' }}">▲</span>
                                                <span class="sort-down {{ request('sort') == 'action' && request('direction') == 'desc' ? 'active' : '' }}">▼</span>
                                            </span>
                                            
                                        </a>
                                    </th>

                                    <th class="">
                                        <a href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'description',
                                            'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                            'page' => null,
                                        ]) }}" class="text-dark text-decoration-none d-flex align-items-center">

                                            <i class="fa-solid fa-align-left me-1 text-muted"></i>
                                            <span class="me-1">Descrição</span>

                                            <span class="sort-icons ms-1">
                                                <span class="sort-up {{ request('sort') == 'description' && request('direction') == 'asc' ? 'active' : '' }}">▲</span>
                                                <span class="sort-down {{ request('sort') == 'description' && request('direction') == 'desc' ? 'active' : '' }}">▼</span>
                                            </span>
                                            
                                        </a>
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
                                                @if($log->user)
                                                <a href="{{ route('dashboard.users.show', $log->user->id) }}" class="text-decoration-none text-dark" target="_blank">
                                                    <span class="fw-semibold">{{ $log->user->name }} </span>
                                                    <small class="text-muted ">
                                                        #{{ $log->user->id }}
                                                    </small>
                                                </a>
                                                @else
                                                    <span class="">{{ $log->model?->name ?? "Sistema"}}</span>
                                                    <small class="text-muted ">
                                                        #{{ $log->model_id }}
                                                    </small>
                                                @endif
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
                                            <button 
                                                class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="modal"
                                                data-bs-target="#logModal"
                                                id="btn-view"
                                                
                                                data-id="{{ $log->id }}"
                                                data-date="{{ $log->created_at }}"
                                                data-action="{{ $log->action }}"
                                                data-user="{{ $log->user->name ?? 'Sistema' }}"
                                                data-surname="{{ $log->user->surname ?? 'Sistema' }}"
                                                data-ip="{{ $log->ip_address }}"
                                                data-model="{{ $log->model_type }}"
                                                data-modelid="{{ $log->model_id }}"
                                                data-desc="{{ $log->description }}"
                                            >
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach

                                @for ($i = $logs->count(); $i < $logs->perPage(); $i++)
                                    <tr class="text-muted">
                                        <td>—</td>
                                        <td>—</td>
                                        <td>—</td>
                                        <td>—</td>
                                        <td>—</td>
                                    </tr>
                                @endfor


                            </tbody>
                        </table>
                    </div>

                    {{-- Paginação --}}
                    <div class="d-flex justify-content-between align-items-center mt-3">

                        <small class="text-muted" id="print-info">
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
                                    <strong class="me-2"     
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="right"
                                    title="{{ $badge['text'] }}">
                                        {{ $log->user->name ?? 'Sistema' }}
                                        <i class="ms-1 {{ $badge['icon'] }}"></i>
                                    </strong>

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



<div class="modal fade" id="logModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="title-log">Dados do Log</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <pre id="logDump" style="white-space: pre-wrap;"></pre>
            </div>

        </div>
    </div>
</div>

@endsection