<?php

use App\Models\AppLog; // Importe o seu model aqui
use Illuminate\Support\Facades\Auth;


if (!function_exists('app_log')) {
    /**
     * Regista uma ação de auditoria no sistema.
     *
     * @param string $action Ex: 'Created', 'Updated', 'Deleted'
     * @param mixed $model O objeto do Model (ex: $user, $pet)
     * @param string $description Mensagem amigável
     * @return void
     */
    function app_log($action, $model, $description)
    {
        AppLog::create([
            'user_id'     => Auth::id() ?? null, // Pega o ID do user logado automaticamente
            'action'      => $action,
            'description' => $description,
            'model_type'  => $model ? get_class($model) : null, // Armazena o caminho do Model (ex: App\Models\Pet)
            'model_id'    => $model->id ?? null,       // Pega o ID do registo afetado
            'ip_address'  => request()->ip(), // Captura o IP do usuário
            'created_at'  => now(),
        ]);
    }
}

if (!function_exists('getLogBadge')) {
    function getLogBadge($action) {
        return match($action) {
            'Login' => [
                'class' => 'bg-success',
                'icon' => 'fas fa-sign-in-alt',
                'text' => 'Login',
            ],
            'Logout' => [
                'class' => 'bg-warning text-dark',
                'icon' => 'fas fa-sign-out-alt',
                'text' => 'Logout',
            ],
            'Error' => [
                'class' => 'bg-danger',
                'icon' => 'fas fa-exclamation-circle',
                'text' => 'Error',
            ],
            'Updated' => [
                'class' => 'bg-info text-dark',
                'icon' => 'fas fa-edit',
                'text' => 'Updated',
            ],
            'Export' => [
                'class' => 'bg-primary',
                'icon' => 'fas fa-file-export',
                'text' => 'Export',
            ],
            default => [
                'class' => 'bg-secondary',
                'icon' => 'fas fa-info-circle',
                'text' => ucfirst($action),
            ],
        };
    }
}