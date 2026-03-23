<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppLog extends Model
{
    // Como a tabela chama 'app_logs', o Laravel já identifica sozinho.
    // Mas vamos desabilitar o timestamp padrão pois usamos apenas 'created_at' manualmente ou customizado.
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'ip_address',
        'description',
        'model_type',
        'model_id',
        'created_at',
    ];

    // Dica: Se quiser que o Laravel trate o created_at como uma data real:
    protected $casts = [
        'created_at' => 'datetime',
    ];
}