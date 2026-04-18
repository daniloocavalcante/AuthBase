@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Edit Profile') }}
@endsection

@section('content')
<div class="container">
    
    <div class="row justify-content-center g-3">

        <div class="col-lg-8 col-md-7">            

            <!-- Breadcrumb de Navegação -->
            <nav aria-label="breadcrumb" class="bg-dark px-3 py-2 rounded mb-2">
                <ol class="breadcrumb mb-0 small">

                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" class="text-light text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('profile') }}" class="text-light text-decoration-none">
                            Meu Perfil
                        </a>
                    </li>

                    <li class="breadcrumb-item active text-light opacity-75" aria-current="page">
                        Editar Perfil
                    </li>

                </ol>
            </nav>
            

            {{-- Mensagens do servidor --}}
            <x-alerts.messages />


            <div class="card shadow-lg border-0 mb-3">

                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Editar Perfil</span>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')                    

                    <div class="card-body">

                        <div class="row justify-content-center">

                            <!-- Foto -->
                            <div class="col-md-4 text-center border-end">

                                <img src="{{ $badge['img'] }}?v=2"
                                    class="img-fluid rounded-circle shadow mb-3"
                                    style="width:120px;height:120px;object-fit:cover;">


                                <h5 class="mb-0">{{ $user->name }} {{ $user->surname }}</h5>

                                <!-- Badge -->                                                        
                                <div class="py-2">

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
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-user me-1"></i>
                                        Nome
                                    </label>
                                    <div class="col-7">
                                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-user-tag me-1"></i>
                                        Sobrenome
                                    </label>
                                    <div class="col-7">
                                        <input type="text" name="surname" class="form-control form-control-sm" value="{{ $user->surname }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-calendar-days me-1"></i>
                                        Data de nascimento
                                    </label>
                                    <div class="col-7">
                                        <input type="date" name="birth" class="form-control form-control-sm" value="{{ $user->birth->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-5 col-form-label text-muted">
                                        <i class="fa-solid fa-venus-mars me-1"></i>
                                        Gênero
                                    </label>
                                    <div class="col-7">
                                        <select name="gender" class="form-select form-select-sm">
                                            @foreach(\App\Enums\Gender::options() as $value => $label)
                                                <option value="{{ $value }}">
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                           
                            </div>

                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-light d-flex justify-content-end gap-2 flex-wrap">

                        <div class="me-auto">
                            <a href="{{ route('profile') }}" tabindex="-1" class="btn btn-primary btn-sm ">
                                Meu Perfil
                            </a> 
                        </div>

                        <a href="{{ route('email.edit') }}" tabindex="-1" class="btn btn-outline-secondary btn-sm">
                            Alterar E-mail
                        </a>

                        <a href="{{ route('password.edit') }}" tabindex="-1" class="btn btn-outline-dark btn-sm">
                            Alterar Senha
                        </a>


                        <button type="submit" class="btn btn-success btn-sm">
                            Salvar Alterações
                        </button>

                    </div>
                </form>

            </div>

            <div class="card shadow-lg border-0">

                <!-- Header -->
                <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <span class="fs-5">Minhas Atividades</span>
                </div>

                <div class="card-body p-1">

                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Ação</th>
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>
                                            {{ $log->created_at?->format('d/m/Y')  }}
                                        </td>
                                        <td>
                                            {{ $log->created_at?->format('H:i:s')  }}
                                        </td>                                       
                                        

                                        <td>
                                            <span class="badge {{ getLogBadge($log->action)['class'] }}"> 
                                                <i class="{{ getLogBadge($log->action)['icon'] }} me-1"></i>
                                                {{ getLogBadge($log->action)['text'] }}
                                            </span>
                                        </td>

                                        <td>
                                            <small class="text-muted">
                                                {{ $log->ip_address ?? '-' }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">
                                            Nenhuma atividade encontrada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- Footer -->
                <div class="card-footer bg-light d-flex justify-content-between align-items-center flex-wrap">
                    
                    <!-- Info -->
                    <small class="text-muted">
                        Mostrando {{ $logs->firstItem() ?? 0 }} até {{ $logs->lastItem() ?? 0 }} de {{ $logs->total() }} logs
                    </small>

                    <!-- Paginação -->
                    <div style="transform: scale(0.8); transform-origin: right;">
                        {{ $logs->onEachSide(1)->links() }}
                    </div>
                </div>


            </div>



        </div>

        <!-- Card guia rápido -->

        <div class="col-lg-4 col-md-5">
            <x-dashboard.quick-guide-card /> 
        </div>

    </div>
</div>



@endsection
