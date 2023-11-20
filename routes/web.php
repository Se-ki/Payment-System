<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentRecordsController;
use App\Http\Controllers\PaymentsController;
use App\Models\Payments;

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
        Route::get('/payments', [PaymentsController::class, 'index'])->name('payments.index');
        Route::post('/payments/pay', [PaymentRecordsController::class, 'store'])->name('payments.pay');
        Route::get('/records', [PaymentRecordsController::class, 'index'])->name("records.index");
        Route::resource('payments', PaymentsController::class);
        Route::resource('records', PaymentRecordsController::class);
    });

    //admin route
    Route::middleware('isAdmin')->group(function () {
        //route here
        Route::get('/payments/create', [PaymentsController::class, 'create'])->name('payments.create');
        Route::post('/payments/store', [PaymentsController::class, 'store'])->name('payments-store');
    });
});

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
