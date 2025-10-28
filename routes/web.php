<?php

use Illuminate\Support\Facades\Route;


// Rota 1: Para a URL raiz
Route::view('/', 'index');
// Rota 1: Para a URL raiz
Route::view('/index', 'index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
