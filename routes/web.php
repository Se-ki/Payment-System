<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentPaymentRecordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentBalancePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => view("dashboard"));

    Route::get('/profile', function () {
        return view('profile.index');
    });

    //student route
    Route::middleware('isStudent')->group(function () {
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::post('/payments/pay', [StudentPaymentRecordController::class, 'store'])->name('payments.pay');
        Route::get('/records', [StudentPaymentRecordController::class, 'index'])->name("records.index");
        Route::get('/balance', [StudentBalancePaymentController::class, 'index'])->name("balance.index");
        Route::resource('payments', PaymentController::class);
        Route::resource('records', StudentPaymentRecordController::class);
    });

    //admin route
    Route::middleware('isAdmin')->group(function () {
        //route here
        Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments-store');
    });
});

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
