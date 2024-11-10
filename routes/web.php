<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/events', function () {
        return Inertia::render('Index/Events', [
            'events' => (new App\Http\Controllers\EventController)->index()->toArray(),
            'links' => (new App\Http\Controllers\EventController)->index(),
        ]);
    })->middleware(['auth'])->name('event');
    Route::get('/events/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/events/create', [EventController::class, 'store'])->name('event.store');

    Route::get('/users', [StudentController::class, 'index'])->name('users');
    Route::get('/users/create', [StudentController::class, 'create'])->name('users.create');
    Route::post('/users/create', [StudentController::class, 'store'])->name('users.create');
    Route::get('/users/edit/{student}', [StudentController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{student}', [StudentController::class, 'destroy'])->name('users.delete');

    Route::get('/clearance', fn() => Inertia::render('Clearance'))->name('clearance');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
