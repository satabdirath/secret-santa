<?php

use App\Http\Controllers\SecretSantaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/import', [SecretSantaController::class, 'importEmployees'])->name('import');
Route::post('/generate', [SecretSantaController::class, 'generateSecretSanta'])->name('generate');
Route::get('/export', [SecretSantaController::class, 'exportAssignments'])->name('export');

});

require __DIR__.'/auth.php';
