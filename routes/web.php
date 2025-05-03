<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
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

// Route::get('/', function () { return view('welcome'); });

Route::get('/', [BookingController::class, 'index']);
Route::post('/book', [BookingController::class, 'store'])->name('book.rooms');
Route::post('/generate-random', [RoomController::class, 'generateRandom'])->name('rooms.random');
Route::post('/reset', [RoomController::class, 'reset'])->name('rooms.reset');

