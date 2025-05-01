<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\MpesaController;

// Public route - Accessible to all users
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authenticated dashboard (redirects to books index)
Route::get('/dashboard', function () {
    return redirect()->route('books.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes group
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Books resource (CRUD operations)
    Route::resource('books', BookController::class);
});

//send user to donations page
Route::get('/donate',[DonationController::class, 'index'])->name('donate');

//mpesa routes
Route::post('/stk-push', [MpesaController::class, 'initiateSTKPush']);
Route::post('/callback', [MpesaController::class, 'callback']);
require __DIR__.'/auth.php';