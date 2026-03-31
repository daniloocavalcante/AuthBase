@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || Tabela de Usuários
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center g-3">

    <div class="col-md-7">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-3">
            <ol class="breadcrumb mb-0 small">

                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-light text-decoration-none">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                    Usuários
                </li>

            </ol>
        </nav>

        {{-- Mensagens do servidor --}}
        <x-alerts.messages />


        <!-- Card -->
        <div class="card shadow-lg border-0 printable" id="card-users">
            
                <!-- HEADER -->
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center">

                    <div class="me-3 text-primary fs-4">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <div>
                        <h6 class="mb-0 fw-semibold">
                            Tabela Usuários
                        </h6>

                        <small class="text-muted d-block">
                            Gerenciamento de contas do sistema
                        </small>

                    </div>
                </div>


            </div>

            <div class="card-body pt-0">

                <!-- TOOLBAR -->
                <div class="d-flex justify-content-between align-items-center py-3 d-print-none" >

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

                <!-- TABELA -->

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                        <tr>

                            <th style="width:60px">ID</th>

                            <th>
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'name',
                                    'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                    'page' => null,
                                ]) }}" class="text-dark text-decoration-none d-flex align-items-center">

                                    <i class="fa-solid fa-user me-1 text-muted"></i>
                                    <span class="me-1">Nome</span>

                                    <span class="sort-icons ms-1">
                                        <span class="sort-up {{ request('sort') == 'name' && request('direction') == 'asc' ? 'active' : '' }}">▲</span>
                                        <span class="sort-down {{ request('sort') == 'name' && request('direction') == 'desc' ? 'active' : '' }}">▼</span>
                                    </span>
                                </a>
                            </th>

                            <th>
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'email',
                                    'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                    'page' => null,
                                ]) }}" class="text-dark text-decoration-none d-flex align-items-center">

                                    <i class="fa-solid fa-envelope me-1 text-muted"></i>
                                    <span class="me-1">Email</span>

                                    <span class="sort-icons ms-1">
                                        <span class="sort-up {{ request('sort') == 'email' && request('direction') == 'asc' ? 'active' : '' }}">▲</span>
                                        <span class="sort-down {{ request('sort') == 'email' && request('direction') == 'desc' ? 'active' : '' }}">▼</span>
                                    </span>
                                </a>
                            </th>

                            <th>
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => 'created_at',
                                    'direction' => request('direction') == 'asc' ? 'desc' : 'asc',
                                    'page' => null,
                                ]) }}" class="text-dark text-decoration-none d-flex align-items-center">

                                    <i class="fa-solid fa-calendar me-1 text-muted"></i>
                                    <span class="me-1">Criado</span>

                                    <span class="sort-icons ms-1">
                                        <span class="sort-up {{ request('sort') == 'created_at' && request('direction') == 'asc' ? 'active' : '' }}">▲</span>
                                        <span class="sort-down {{ request('sort') == 'created_at' && request('direction') == 'desc' ? 'active' : '' }}">▼</span>
                                    </span>
                                    
                                </a>
                            </th>

                            <th class="text-end d-print-none">
                                Ações
                            </th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($users as $user)

                        <tr>

                            <td class="text-muted fw-semibold">
                                {{ $user->id }}
                            </td>

                            <td>   

                                <a href="{{ route('dashboard.users.show', $user->id) }}" class="d-flex align-items-center text-decoration-none text-dark">

                                    <div class="me-2 text-secondary fs-5">
                                        <i class="fa-solid fa-circle-user"></i>
                                    </div>

                                    <div>
                                        <div class="fw-semibold">
                                            {{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}
                                        </div>
                                    </div>
                                </a>       

                            </td>

                            <td>

                                <span class="text-dark">{{ $user->email }}</span>

                            </td>

                            <td class="text-muted">

                                <i class="fa-regular fa-clock me-1"></i>
                                {{ $user->created_at->format('d/m/Y') }}

                            </td>

                            <td class="text-end d-print-none">

                                <div class="dropdown">

                                    <button class="btn btn-sm btn-light"
                                        data-bs-toggle="dropdown">

                                        <i class="fa-solid fa-ellipsis"></i>

                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">

                                        <!-- Visualizar -->
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.users.show', $user->id) }}">
                                                <i class="fa-solid fa-eye me-2 text-secondary"></i>
                                                <span>Visualizar</span>
                                            </a>
                                        </li>

                                    </ul>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                        @for ($i = $users->count(); $i < 10; $i++)
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

                <!-- PAGINAÇÃO -->

                <div class="d-flex justify-content-between align-items-center mt-3">

                    <small class="text-muted" id="print-info">
                        Mostrando {{ $users->firstItem() }} até {{ $users->lastItem() }}
                        de {{ $users->total() }} usuários
                    </small>

                    {{ $users->links() }}

                </div>

            </div>

        </div>

    </div>

  
    <div class="col-lg-4 col-md-5">
        <!-- Card Estatísticas -->
        <div class="card shadow border-0 mb-3">

            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-chart-simple me-2"></i>
                Estatísticas
            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total de Usuários</span>
                    <span class="fw-semibold">{{ $usersCount }}</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Administradores</span>
                    <span class="fw-semibold">{{ $adminsCount }}</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span class="text-muted">Cadastrados hoje</span>
                    <span class="fw-semibold">{{ $todayUsers }}</span>
                </div>

            </div>

        </div>

        <!-- Card guia rápido -->
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
        Você tem certeza que deseja exportar os dados dos usuários para CSV?
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="{{ route('dashboard.users.export') }}" id="confirmExportBtn"  class="btn btn-primary">Confirmar Exportar</a>
      </div>

    </div>
  </div>
</div>



@endsection
