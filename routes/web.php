<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\GymController;
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

Route::resource('gyms', GymController::class);
Route::post('/gyms/massStore', [GymController::class, 'massStore'])->name('gyms.massStore');

Route::resource('clients', ClientController::class);

require __DIR__.'/auth.php';
