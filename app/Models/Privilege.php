<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $badge_color
 * @property string $actions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege whereActions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege whereBadgeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Privilege whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Privilege extends Model
{
    protected $fillable = ['name', 'badge_color', 'actions'];

    // Relacionamento inverso: um privilégio pode ter vários usuários
    public function users()
    {
        return $this->hasMany(User::class);
    }
}