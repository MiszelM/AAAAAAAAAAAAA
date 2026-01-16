<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreditOfferController;
use App\Http\Controllers\PracownikController;
use App\Http\Controllers\KlientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WniosekKredytowyController;
use App\Http\Controllers\KredytController;
use App\Http\Controllers\OcenaController;
use App\Livewire\CreditOfferTable;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/klienci', [KlientController::class, 'index'])->name('klienci.index');

Route::get('/pracownicy', [PracownikController::class, 'index'])->name('pracownicy.index');

Route::get('/wnioski', [WniosekKredytowyController::class, 'index'])->name('wniosek_kredytowies.index');

Route::get('/oferty', [CreditOfferController::class, 'index'])->name('oferty.index');

Route::get('/oceny', [OcenaController::class, 'index'])->name('ocenas.index');

Route::get('/kredyty', [KredytController::class, 'index'])->name('kredyts.index');


Route::get('/profile/edit', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('profile.edit');

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

require __DIR__.'/auth.php';
