<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MapaController;

use App\Http\Controllers\ConfeitariaController;
use App\Http\Controllers\ProdutoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('confeitarias', ConfeitariaController::class);
});

Route::get('/', function () {   
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return redirect('/confeitarias');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/confeitarias/{confeitaria}/produtos', [ProdutoController::class, 'porConfeitaria'])->name('confeitarias.produtos');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('produtos', ProdutoController::class);
});

Route::get('/confeitarias/{id}/edit', [ConfeitariaController::class, 'edit']);
Route::put('/confeitarias/{id}', [ConfeitariaController::class, 'update']);


require __DIR__.'/auth.php';
