<div class="card shadow border-0 ">

    <div class="card-header bg-white d-flex align-items-center">
        <div class="fw-semibold">
            <i class="fa-solid fa-compass text-primary me-2"></i>
            Guia rápido
        </div>
    </div>

    <div class="card-body">

        <p class="text-muted small mb-3">
            Acesse rapidamente as principais funcionalidades do painel.
        </p>

        <div class="list-group list-group-flush">

            <a href="{{ route('dashboard.index') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2">
                <i class="fa-solid fa-gauge me-2 text-primary"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold small">Dashboard</div>
                    <small class="text-muted">Página principal</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted small"></i>
            </a>

            <a href="{{ route('dashboard.profile') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2">
                <i class="fa-solid fa-user me-2 text-secondary"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold small">Perfil</div>
                    <small class="text-muted">Suas informações</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted small"></i>
            </a>

            <a href="{{ route('dashboard.profile.edit') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2">
                <i class="fa-solid fa-user-pen me-2 text-info"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold small">Editar perfil</div>
                    <small class="text-muted">Atualizar dados</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted small"></i>
            </a>

            <a href="{{ route('dashboard.email.edit') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2">
                <i class="fa-solid fa-envelope me-2 text-primary"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold small">Editar e-mail</div>
                    <small class="text-muted">Atualizar e-mail</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted small"></i>
            </a>

            <a href="{{ route('dashboard.password.edit') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2">
                <i class="fa-solid fa-key me-2 text-warning"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold small">Alterar senha</div>
                    <small class="text-muted">Segurança da conta</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted small"></i>
            </a>

            <a href="{{ route('dashboard.users') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2">
                <i class="fa-solid fa-users me-2 text-success"></i>
                <div class="flex-grow-1">
                    <div class="fw-semibold small">Usuários</div>
                    <small class="text-muted">Gerenciar usuários</small>
                </div>
                <i class="fa-solid fa-chevron-right text-muted small"></i>
            </a>

        </div>

    </div>
</div>