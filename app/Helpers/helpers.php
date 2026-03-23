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
            'model_type'  => get_class($model), // Armazena o caminho do Model (ex: App\Models\Pet)
            'model_id'    => $model->id,       // Pega o ID do registo afetado
            'ip_address'  => request()->ip(), // Captura o IP do usuário
            'created_at'  => now(),
        ]);
    }
}
