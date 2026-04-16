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
    { /*    

        DISPARANDO JUNTO COM REGISTRED

        
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

        app_log('USER_CREATED', $user, $desc); */ 
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

        // ------------------------
        // Log de e-mail específico
        // ------------------------
        if (isset($changes['email'])) {
            $oldValue = $original['email'] ?? null;
            $newValue = $changes['email'];

            $fields = [];
            $fields[] = "email: '{$oldValue}' → '{$newValue}'";

            $creator = Auth::user();
            $desc = $creator
                ? " Usuário alterou a própria senha."
                : "E-mail alterado automaticamente: ";
            $desc .= implode(', ', $fields);

            app_log('EMAIL_UPDATED', $user, $desc);

            // remove do changes para não gerar USER_UPDATED
            unset($changes['email']);
        }

        // ------------------------
        // Log de senha específico
        // ------------------------
        static $alreadyLogged = false;

        if (!$alreadyLogged && $user->wasChanged('password')) {
            $alreadyLogged = true;

            $creator = Auth::user();

            if ($creator) {
                $desc = "Senha alterada por {$creator->name}";
                app_log('PASSWORD_UPDATED', $user, $desc);
            }
        }

        // ------------------------
        // Log genérico para outros campos
        // ------------------------
        $fields = [];
        foreach ($changes as $field => $newValue) {
            if (in_array($field, ['last_login', 'updated_at','email_verified_at', 'remember_token', 'password'])) {
                continue;
            }
            $oldValue = $original[$field] ?? null;
            $fields[] = "{$field}: '{$oldValue}' → '{$newValue}'";
        }

        if (!empty($fields)) {
            $creator = Auth::user();
            $desc = $creator
                ? "Atualizado por {$creator->name}: "
                : "Atualização automática: ";
            $desc .= implode(', ', $fields);

            app_log('USER_UPDATED', $user, $desc);
        }
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
