<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

use App\Models\User;
use App\Observers\UserObserver;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\{
    Login,
    Logout,
    Registered,
    PasswordReset,
    Failed,
    Lockout,
    Authenticated,
    Verified,
};

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();
        Carbon::setLocale(config('app.locale'));

        // Observer
        User::observe(UserObserver::class);

        // Auth Logs
        $this->registerAuthLogs();
    }

    private function registerAuthLogs(): void
    {
        Event::listen(Login::class, fn($e) =>
            $this->log('LOGIN', $e->user, 'Usuário fez login.')
        );

        Event::listen(Logout::class, fn($e) =>
            $this->log('LOGOUT', $e->user, 'Usuário fez logout.')
        );

        Event::listen(Registered::class, fn($e) =>
            $this->log('REGISTER', $e->user, 'Novo usuário registrado.')
        );

         Event::listen(PasswordReset::class, fn($e) =>
            $this->log('PASSWORD_RESET', $e->user, 'Senha redefinida via recuperação por e-mail.')
        ); 

        Event::listen(Failed::class, fn($e) =>
            $this->log('LOGIN_FAILED', null, 'Tentativa de login inválida: ' . ($e->credentials['email'] ?? 'N/A'))
        ); 

        Event::listen(Lockout::class, fn() =>
            $this->log('LOCKOUT', null, 'Muitas tentativas. IP: ' . request()->ip())
        );

        Event::listen(Verified::class, fn($e) =>
            $this->log('EMAIL_VERIFIED', $e->user, 'E-mail verificado.')
        );
    }

    private function log($action, $user, $description): void
    {
        app_log($action, $user, $description);
    }
}

        
/* 
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

VerifyEmail::toMailUsing(function ($notifiable, $url) {
    return (new MailMessage)
        ->subject('Confirme seu e-mail')
        ->greeting('Olá, ' . $notifiable->name . ' 👋')
        ->line('Estamos quase lá!')
        ->line('Para ativar sua conta, confirme seu e-mail clicando no botão abaixo.')
        ->action('Confirmar meu e-mail', $url)
        ->line('Esse link expira em alguns minutos.')
        ->line('Se você não criou uma conta, pode ignorar este e-mail com segurança.');
});*/


