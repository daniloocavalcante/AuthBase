<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if (
            app()->runningInConsole() ||
            (request()->route() && request()->routeIs('register'))
        ) {
            return;
        }

        $creator = Auth::user();

        $desc = $creator
            ? "Usuário criado por {$creator->name}."
            : "Usuário criado via sistema.";

        app_log('USER_CREATED', $user, $desc);
    }


    /**
     * Handle the User "updated" event.
     */

    public function updated(User $user): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        if (!$user->wasChanged()) {
            return;
        }

        $changes = $user->getChanges();
        $original = $user->getOriginal();

        $fields = [];

        foreach ($changes as $field => $newValue) {
            // ignora campos que não fazem sentido logar
            if (in_array($field, ['last_login', 'updated_at', 'password', 'remember_token'])) {
                continue;
            }

            $oldValue = $original[$field] ?? null;

            $fields[] = "{$field}: '{$oldValue}' → '{$newValue}'";
        }

        if (empty($fields)) {
            return;
        }

        $creator = Auth::user();

        $desc = $creator
            ? "Atualizado por {$creator->name}: "
            : "Atualização automática: ";

        $desc .= implode(', ', $fields);

        app_log('USER_UPDATED', $user, $desc);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        app_log('USER_DELETED', $user, 'Usuário removeu a própria conta.');
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {

        if (app()->runningInConsole()) {
            return;
        }

        app_log('USER_RESTORED', $user, 'Usuário restaurado.');
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        if (app()->runningInConsole()) {
            return;
        }
        app_log('USER_FORCE_DELETED', $user, 'Usuário removido permanentemente.');
    }
}
