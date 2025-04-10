<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BookingController;

Route::get('/', fn() => redirect('/entities'));

Route::get('/entities', [EntityController::class, 'index'])->name('entities.index');
Route::get('/entities/{entity}', [EntityController::class, 'show'])->name('entities.show');
Route::get('/entities/{entity}/book', [ItemController::class, 'create'])->name('items.create');

Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::put('/items/{item}/done', [ItemController::class, 'markDone'])->name('items.done');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

Route::get('/items/{item}/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/items/{item}/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/items/{item}/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::put('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
