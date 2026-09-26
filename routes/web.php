<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//rutas de los usuarios
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "Bienvenido Panel Administrador";
    });
});

Route::middleware(['auth', 'role:supervisor,admin'])->group(function () {
    Route::get('/supervisor/dashboard', function () {
        return "Bienvenido Panel Supervisor";
    });
});

Route::middleware(['auth', 'role:contador,supervisor,admin'])->group(function () {
    Route::get('/contador/dashboard', function () {
        return "Bienvenido Panel Contador";
    });
});
// terminación de rutas de los usuarios

require __DIR__.'/auth.php';
