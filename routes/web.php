<?php

use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PayMongoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueueController;
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
    Route::post('/payments/create', [PaymentsController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payments}', [PaymentsController::class, 'show'])->name('payments.show');

    // Payment Status
    Route::patch('/payments/{payments}', [PaymentsController::class, 'pay'])->name('payments.pay');

    // Queue
    Route::get('/queue', [QueueController::class, 'index'])->name('queue');
    Route::get('/queue/start', [QueueController::class, 'startQueue'])->name('queue.start');
    Route::get('/queue/{student}', [QueueController::class, 'show'])->name('queue.show');
    Route::get('/queue/{student}/clearance', [QueueController::class, 'studentClearance'])->name('queue.show-clearance');
    Route::post('/queues/{queue}/approve', [QueueController::class, 'approveQueue'])->name('queue.approve');
    Route::get('/queue/admin/{signingOffice}', [QueueController::class, 'officeQueue'])->name('queue.office');

    // Clearance
    Route::get('/clearance', [ClearanceController::class, 'index'] )->name('clearance');
    Route::post('/clearance/start', [ClearanceController::class, 'start'])->name('clearance.start');
    Route::post('/clearance/end', [ClearanceController::class, 'end'])->name('clearance.end');
    Route::get('/clearance/{signingOffice}', [ClearanceController::class, 'show'])->name('clearance.show');

    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PayMongo
    Route::post('/create-gcash-payment', [PayMongoController::class, 'createGCashPayment']);
    Route::post('/paymongo/webhook', [PayMongoController::class, 'handlePaymentWebhook']);
    Route::get('/payment-return', [PayMongoController::class, 'handlePaymentReturn']);
});

require __DIR__.'/auth.php';
