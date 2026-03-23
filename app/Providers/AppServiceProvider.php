<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Carbon::setLocale(config('app.locale'));
        
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
    }
}

