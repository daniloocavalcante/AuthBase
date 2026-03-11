<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;


Route::view('/', 'index')->name('index');
Route::view('/about', 'about')->name('about');

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
*/

// ---------------------- LOGIN ----------------------
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// ---------------------- REGISTRO ----------------------
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// ---------------------- RECUPERAÇÃO DE SENHA ----------------------
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// ---------------------- DASHBOARD ----------------------
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('profile');

    // Editar Usuário
    Route::get('/dashboard/edit/profile', [DashboardController::class, 'edit'])->name('profile.edit');
    Route::put('/dashboard/update/profile', [DashboardController::class, 'update'])->name('profile.update');

    // Deletar Conta
    Route::delete('/profile', [DashboardController::class, 'destroy'])->name('profile.destroy');

    // Alterar senha
    Route::get('/dashboard/change-password', [DashboardController::class, 'showChangePasswordForm'])->name('dashboard.change-password');
    Route::post('/dashboard/change-password', [DashboardController::class, 'changePassword'])->name('profile.password.update');

    Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('dashboard.users');

    // Tabela de usuários (somente para admin ou teste)
    //Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users');

});

