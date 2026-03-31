<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $action
 * @property string|null $ip_address
 * @property string $description
 * @property string|null $model_type
 * @property int|null $model_id
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppLog whereUserId($value)
 * @mixin \Eloquent
 */
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->morphTo(); // se for polimórfico
    }


}