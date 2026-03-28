<div class="card shadow border-0">

    <div class="card-header bg-white d-flex align-items-center py-3">
        <div class="fw-semibold fs-5">
            <i class="fa-solid fa-compass text-primary me-2"></i>
            Guia rápido
        </div>
    </div>

    <div class="card-body">

        <p class="text-muted mb-4">
            Utilize os atalhos abaixo para acessar rapidamente as principais funções do sistema.
        </p>

        <div class="list-group list-group-flush">

            <a href="{{ route('login') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                <i class="fa-solid fa-right-to-bracket me-3 fs-5 text-primary"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Entrar no sistema</div>
                    <small class="text-muted">Acesse sua conta</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted"></i>
            </a>

            <a href="{{ route('register') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                <i class="fa-solid fa-user-plus me-3 fs-5 text-success"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Criar conta</div>
                    <small class="text-muted">Realize seu cadastro</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted"></i>
            </a>

            <a href="{{ route('password.request') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                <i class="fa-solid fa-key me-3 fs-5 text-warning"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Recuperar senha</div>
                    <small class="text-muted">Redefinir acesso</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted"></i>
            </a>

            <a href="{{ route('about') }}" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                <i class="fa-solid fa-circle-info me-3 fs-5 text-info"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Sobre o projeto</div>
                    <small class="text-muted">Informações do sistema</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted"></i>
            </a>

        </div>

    </div>
</div>