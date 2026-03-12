<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $fillable = ['name', 'badge_color', 'actions'];

    // Relacionamento inverso: um privilégio pode ter vários usuários
    public function users()
    {
        return $this->hasMany(User::class);
    }
}