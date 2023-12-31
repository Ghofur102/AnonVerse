<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    // route untuk authentikasi
    Route::get('/register', function () {
        return view('auth.register');
    });
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    //
});

// route untuk user yang belum login maupun yang sudah login
Route::get('/', function () {
    return view('users.home');
})->name('home');

Route::middleware(['auth'])->group(function () {
    // route logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
