<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreditOfferController;
use App\Http\Controllers\UserController;
use App\Livewire\CreditOfferTable;



Route::get('/credit-offers', function () {
    return view('credit_offers.index');
})->middleware('auth')->name('credit-offers.index');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['permission:users.view'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/role', [UserController::class, 'updateRole'])
        ->middleware('permission:users.assign_role')
        ->name('users.role');
});
Route::get('/profile', function () {
    return 'Profil – do zrobienia';
})->name('profile.edit');

require __DIR__.'/auth.php';
