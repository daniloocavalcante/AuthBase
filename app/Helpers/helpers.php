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

            'LOGIN' => [
                'class' => 'bg-success',
                'icon' => 'fas fa-sign-in-alt',
                'text' => 'Login',
            ],

            'LOGOUT' => [
                'class' => 'bg-secondary',
                'icon' => 'fas fa-sign-out-alt',
                'text' => 'Logout',
            ],

            'LOGIN_FAILED' => [
                'class' => 'bg-danger',
                'icon' => 'fas fa-times-circle',
                'text' => 'Falha no Login',
            ],

            'LOCKOUT' => [
                'class' => 'bg-dark',
                'icon' => 'fas fa-user-lock',
                'text' => 'Conta Bloqueada',
            ],

            'REGISTER' => [
                'class' => 'bg-primary',
                'icon' => 'fas fa-user-plus',
                'text' => 'Cadastro',
            ],

            'PASSWORD_RESET_REQUEST' => [
            'class' => 'bg-warning text-dark',
            'icon' => 'fas fa-key',
            'text' => 'Recuperação',
            ],

            'PASSWORD_RESET' => [
                'class' => 'bg-warning text-dark',
                'icon' => 'fas fa-key',
                'text' => 'Reset de Senha',
            ],

            'EMAIL_CONFIRMATION' => [
                'class' => 'bg-info',
                'icon' => 'fas fa-envelope',
                'text' => 'Confirmação',
            ],

            'EMAIL_VERIFIED' => [
                'class' => 'bg-success',
                'icon' => 'fas fa-envelope-open-text',
                'text' => 'Verificado',
            ],

            'USER_CREATED' => [
                'class' => 'bg-info text-dark',
                'icon' => 'fas fa-user-plus',
                'text' => 'Usuário Criado',
            ],

            'USER_UPDATED' => [
                'class' => 'bg-info text-dark',
                'icon' => 'fas fa-user-edit',
                'text' => 'Usuário Atualizado',
            ],
            'PASSWORD_UPDATED' => [
                'class' => 'bg-warning text-dark',
                'icon' => 'fas fa-user-lock',
                'text' => 'Senha Alterada',
            ],
            'EMAIL_UPDATED' => [
                'class' => 'bg-warning text-dark',
                'icon' => 'fas fa-envelope',
                'text' => 'E-mail Atualizado',
            ],

            'USER_DELETED' => [
                'class' => 'bg-danger',
                'icon' => 'fas fa-user-times',
                'text' => 'Usuário Removido',
            ],

            'USER_RESTORED' => [
                'class' => 'bg-success',
                'icon' => 'fas fa-user-check',
                'text' => 'Usuário Restaurado',
            ],

            'USER_FORCE_DELETED' => [
                'class' => 'bg-dark',
                'icon' => 'fas fa-skull-crossbones',
                'text' => 'Remoção Permanente',
            ],

            'EXPORT' => [
                'class' => 'bg-primary',
                'icon' => 'fas fa-file-export',
                'text' => 'Exportação',
            ],
            'EXPORT_LOG' => [
                'class' => 'bg-primary',
                'icon' => 'fa fa-save',
                'text' => 'Exportação',
            ],
            'ERROR' => [
                'class' => 'bg-danger',
                'icon' => 'fas fa-exclamation-triangle',
                'text' => 'Erro',
            ],

            default => [
                'class' => 'bg-secondary',
                'icon' => 'fas fa-info-circle',
                'text' => ucfirst(strtolower($action)),
            ],
        };
    }
}


if (!function_exists('getUserBadge')) {
        function getUserBadge($role)
        {
            return match ($role) {
                'admin' => (object) [
                    'text' => 'Administrador',
                    'label' => 'Adm',
                    'class' => 'text-bg-dark',
                    'img' => asset('images/admin.png'),
                ],
                'user' => (object) [
                    'text' => 'Usuário Comum',
                    'label' => 'User',
                    'class' => 'bg-primary',
                    'img' => asset('images/default.png'),
                ],
            default => (object) [
                'text' => ucfirst($role),
                'label' => strtolower(substr($role, 0, 4)),
                'class' => 'bg-secondary',
                'img' => asset('images/default.png'),
            ],
        };
    }
}  

if (!function_exists('format_compact_number')) {
    function format_compact_number(int|float $number): string
    {
        if ($number < 1000) {
            return (string) $number;
        }

        if ($number < 1000000) {
            $value = floor(($number / 1000) * 10) / 10;
            $suffix = 'K';
        } elseif ($number < 1000000000) {
            $value = floor(($number / 1000000) * 10) / 10;
            $suffix = 'M';
        } else {
            $value = floor(($number / 1000000000) * 10) / 10;
            $suffix = 'B';
        }

        return rtrim(rtrim(number_format($value, 1), '0'), '.') . $suffix;
    }
}