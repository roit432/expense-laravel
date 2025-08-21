<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;//used to interact with the Transaction model

Route::get('/', function () {
    return view('transactions.index');
});//this route will return the index view of transactions
Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});//this route will return the index view of transactions for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
});//this route will return the create view of transactions for authenticated users and store the transaction in the database
Route::middleware(['auth'])->group(function () {
    Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
});//this route will return the edit view of transactions for authenticated users and update the transaction in the database
Route::middleware(['auth'])->group(function () {
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});//this route will delete the transaction from the database for authenticated users
Route::middleware(['auth'])->group(function () {
 Route::get('/transactions/report', [TransactionController::class, 'report'])->name('transactions.report');
});//this route will return the report view of transactions for authenticated users

Route::view('pie', 'transactions.pie')->name('transactions.pie');//this route will return the pie chart view of transactions



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//this route will return the profile view for authenticated users and allow them to edit, update or delete their profile
require __DIR__.'/auth.php';
