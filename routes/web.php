<?php

use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    // Events
    Route::get('/events', [EventController::class, 'index'])->name('event');
    Route::get('/events/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/events/create', [EventController::class, 'store'])->name('event.store');

    // Students
    Route::get('/users', [StudentController::class, 'index'])->name('users');
    Route::get('/users/create', [StudentController::class, 'create'])->name('users.create');
    Route::post('/users/create', [StudentController::class, 'store'])->name('users.create');
    Route::get('/users/edit/{student}', [StudentController::class, 'edit'])->name('users.edit');
    Route::patch('/users/edit/{student}', [StudentController::class, 'update'])->name('users.update');
    Route::delete('/users/{student}', [StudentController::class, 'destroy'])->name('users.delete');

    // Payments
    Route::get('/payments', [PaymentsController::class, 'index'])->name('payments');
    Route::get('/payments/create', [PaymentsController::class, 'create'])->name('payments.create');
    Route::get('/payments/{payments}', [PaymentsController::class, 'show'])->name('payments.show');
    Route::post('/payments/create', [PaymentsController::class, 'store'])->name('payments.store');

    // Queue
    Route::get('/queue', fn() => Inertia::render('Queue'))->name('queue');

    // Clearance
    Route::get('/clearance', [ClearanceController::class, 'index'] )->name('clearance');
    Route::get('clearance/start/{signingOffice}', [ClearanceController::class, 'show'])->name('clearance.show');
    Route::post('clearance/start', [ClearanceController::class, 'start'])->name('clearance.start');
    Route::post('clearance/end', [ClearanceController::class, 'end'])->name('clearance.end');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
