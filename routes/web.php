<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::redirect('/', '/dashboard')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('usuarios', [UserController::class, 'index'])->name('usuarios.index');
});
