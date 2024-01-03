<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FeedsController;
use App\Http\Controllers\LikesController;
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
Route::get('/feed', [FeedsController::class, 'index'])->name('feed');
Route::get('/komunitas', function () {
    return view('users.komunitas');
})->name('komunitas');
Route::get('/cari_avatar', function () {
    return view("users.cari_avatar");
})->name('cari.avatar');

Route::middleware(['auth'])->group(function () {
    // route logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // route feed for user
    Route::post('/feed', [FeedsController::class, 'store'])->name('store.feed');
    Route::put('/update-feed', [FeedsController::class, 'update'])->name('update.feed');
    Route::delete('/destroy-feed', [FeedsController::class, 'destroy'])->name('destroy.feed');
    // route like for user
    Route::post('/like-feed', [LikesController::class, 'like_feed'])->name('like.feed');
    Route::post('/like-comment', [LikesController::class, 'like_comment'])->name('like.comment');
    // route comment for user
    Route::resource('/comment', CommentsController::class);
});
