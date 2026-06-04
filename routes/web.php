<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('/', 'home')->name('home');
});

Route::controller(\App\Http\Controllers\AuthController::class)->prefix('/auth')->group(function () {
    Route::get('/login', 'login')->middleware('guest')->name('login');
    Route::post('/login', 'login_store')->middleware('guest')->name('login.store');
    Route::get('/logout', 'logout')->middleware('auth')->name('logout');

    Route::get('/google/redirect', 'google_redirect')->name('auth.google.redirect');
    Route::get('/google/callback', 'google_callback')->name('auth.google.callback');
});

// Conjunto de rotas do admin
Route::prefix('/admin')->group(function () {
    Route::controller(\App\Http\Controllers\DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    // Configurações do site, configurações que não estão encaixadas em nenhuma classe. Tirando isso cada um aspecto tem seu controller
    Route::controller(\App\Http\Controllers\ProfileController::class)->group(function () {
        Route::get('/', 'index')->name('profile');
    });
    
    // Informações do perfil, dados do usuário e informações
    Route::controller(\App\Http\Controllers\ProfileController::class)->group(function () {
        Route::get('/{$user}', 'edit')->name('settings');
        Route::post('/{$user}', 'update')->name('settings.update');
    });
})->middleware('auth');