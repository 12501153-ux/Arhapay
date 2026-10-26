<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingController;
use App\Models\Transaction;


// ==================== HALAMAN AWAL ====================

Route::get('/', function () {
    return redirect()->route('login');
});


// ==================== AUTH ====================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ==================== DASHBOARD ====================

Route::get('/dashboard', function () {

    $transactions = Transaction::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact('transactions'));

})->middleware('auth')->name('dashboard');


// ==================== FITUR USER ====================

Route::middleware('auth')->group(function () {

    // ==================== TRANSFER ====================

    Route::post('/transfer', [TransactionController::class, 'transfer'])
        ->name('transfer');

    Route::get('/transfer', function () {
        return view('transfer');
    })->name('transfer.page');


    // ==================== TOP UP ====================

    Route::post('/topup', [TransactionController::class, 'topup'])
        ->name('topup');

    Route::get('/topup', function () {
        return view('topup');
    })->name('topup.page');


    // ==================== HISTORY ====================

    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history');


    // ==================== TAGIHAN ====================

    Route::get('/bills', [BillController::class, 'index'])
        ->name('bills');

    Route::post('/bills/{bill}/pay', [BillController::class, 'pay'])
        ->name('bills.pay');


    // ==================== PROFILE ====================

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');


    // ==================== QRIS ====================

    Route::get('/qris/{transaction}', [TransactionController::class, 'qris'])
        ->name('qris');

    Route::post('/qris/{transaction}/confirm', [TransactionController::class, 'confirmQris'])
        ->name('qris.confirm');


    // ==================== SAKU UANG ====================

    Route::get('/savings', [SavingController::class, 'index'])
        ->name('savings');

    Route::post('/savings', [SavingController::class, 'store'])
        ->name('savings.store');

        Route::post('/savings/{saving}/deposit', [SavingController::class, 'deposit'])
    ->name('savings.deposit');

Route::post('/savings/{saving}/withdraw', [SavingController::class, 'withdraw'])
    ->name('savings.withdraw');

});