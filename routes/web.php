<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Páginas públicas
|--------------------------------------------------------------------------
*/

Route::view('/', 'index')->name('index');
Route::view('/about', 'about')->name('about');

/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Registro
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// Recuperação de senha
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/password/reset', 'showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('/password/reset', 'reset')->name('password.update');
});


// Verificação de Email 
Route::controller(VerificationController::class)->group(function () {
    Route::get('email/verify', 'show')->name('verification.notice');      

    Route::get('email/verify/{id}/{hash}', 'verify')
        ->middleware(['signed'])
        ->name('verification.verify');

    Route::get('email/verification', 'success')
        ->name('verification.success');
   
    Route::post('email/verification-notification', 'resend')
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.resend');
});


Route::get('/teste-email', function () {
    Mail::raw('Teste de e-mail funcionando!', function ($message) {
        $message->to('teste@email.com')
                ->subject('Teste Laravel Mailpit');
    });

    return 'Email enviado!';
});

/*
|--------------------------------------------------------------------------
| Dashboard (Área autenticada)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->group(function () {
        Route::get('/home', [DashboardController::class, 'index'])
            ->name('home');

        // Perfil
        Route::get('/profile', [DashboardController::class, 'profile'])
            ->middleware('permission:profile')
            ->name('profile');

        Route::get('/profile/edit', [DashboardController::class, 'edit'])
            ->middleware('permission:profile.edit')
            ->name('profile.edit');

        Route::put('/profile', [DashboardController::class, 'update'])
            ->middleware('permission:profile.edit')
            ->name('profile.update');

        Route::delete('/profile', [DashboardController::class, 'destroy'])
            ->middleware('permission:profile.delete')
            ->name('profile.destroy');

        // Email
        Route::get('/email', [DashboardController::class, 'email'])
            ->middleware('permission:profile.email')
            ->name('email.edit');

        Route::put('/email', [DashboardController::class, 'email_update'])
            ->middleware('permission:profile.email')
            ->name('email.update');

        // Senha
        Route::get('/password', [DashboardController::class, 'password'])
            ->middleware('permission:profile.password')
            ->name('password.edit');

        Route::put('/password', [DashboardController::class, 'password_update'])
            ->middleware('permission:profile.password')
            ->name('password.update');

        // Usuários
        Route::get('/users', [DashboardController::class, 'users'])
            ->middleware('permission:users')
            ->name('users');

        Route::get('/users/exportar', [DashboardController::class, 'export'])
            ->middleware('permission:users.export')
            ->name('users.export');

        Route::get('/users/{id}', [DashboardController::class, 'show'])
            ->middleware('permission:users.show')
            ->name('users.show');

        Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])
            ->middleware('permission:logs.show')
            ->name('admin.dashboard');

        // Logs (admin)
        Route::get('/admin/logs', [DashboardController::class, 'logs'])
            ->middleware('permission:admin.dashboard')
            ->name('logs');

        Route::get('/admin/logs/exportar', [DashboardController::class, 'export_logs'])
            ->middleware('permission:logs.export')
            ->name('logs.export');

    });

Route::fallback(function () {
    auth()->shouldUse('web');

    return response()->view('errors.404', [], 404);
});