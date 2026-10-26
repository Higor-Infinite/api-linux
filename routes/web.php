<?php

use Illuminate\Support\Facades\Route;
use App\Enums\Permissao;

Route::redirect('/', '/dashboard')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

Route::middleware(['auth', 'can:' . Permissao::GerenciarUsuarios->value])
    ->group(function () {
        Route::view('usuarios', 'usuarios.index')->name('usuarios.index');
    });
