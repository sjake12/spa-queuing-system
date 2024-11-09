<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/login');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/events', function () {
        return Inertia::render('Events', [
            'events' => (new App\Http\Controllers\EventController)->index()->toArray(),
            'links' => (new App\Http\Controllers\EventController)->index(),
        ]);
    })->middleware(['auth'])->name('event');

    Route::get('/clearance', fn() => Inertia::render('Clearance'))->name('clearance');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
