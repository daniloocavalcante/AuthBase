@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif



<!-- Mensagens Automáticas -->
@if(session('success_name'))
<div class="alert alert-success alert-dismissible fade show">
    <p class="mb-0">Olá, <strong>{{ ucfirst(session('success_name')) }}</strong> ! Você foi logado com sucesso!</p>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>                  
</div>    
@endif


<!-- Verifique seu E-mail -->
@auth

    @if (!auth()->user()->hasVerifiedEmail() && 
        in_array(Route::currentRouteName(), ['dashboard.index', 'dashboard.profile']))
    <div class="alert border-warning bg-warning-subtle d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-envelope fs-5 text-black"></i>        

            <div>
                <span class="fw-semibold">E-mail não verificado. </span>
                <span class="small text-muted">
                    Verifique sua conta.
                </span>
            </div>
        </div>

        <a href="#" 
        class="fw-semibold text-primary text-decoration-none d-flex align-items-center gap-1"
        data-bs-toggle="modal" 
        data-bs-target="#verifyEmail">
            <i class="bi bi-envelope-check fs-6"></i>
            Verificar
        </a>
    </div>

    @endif
@endauth