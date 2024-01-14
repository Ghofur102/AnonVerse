<?php

use App\Http\Controllers\ApprovalAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ComunityCategoriesController;
use App\Http\Controllers\ComunityController;
use App\Http\Controllers\FeedsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\QuestionsAnswersController;
use App\Repositories\ApprovalAdminRepository;
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
Route::get('/komunitas', [ComunityController::class, 'index'])->name('komunitas');
Route::get('/cari_avatar', [AvatarsController::class, 'cari_avatar'])->name('cari.avatar');
// show detail category comunity
Route::get('/detail-komunitas/{name}', [ComunityController::class, 'show'])->name('detail.komunitas');
// show detail answer
Route::get('/detail-jawaban/{id}', [ComunityController::class, 'show_answer'])->name('detail.answer');
Route::middleware(['auth'])->group(function () {
    // route logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // route feed for user
    Route::post('/feed', [FeedsController::class, 'store'])->name('store.feed');
    Route::put('/update-feed', [FeedsController::class, 'update'])->name('update.feed');
    Route::delete('/destroy-feed', [FeedsController::class, 'destroy'])->name('destroy.feed');
    // route like for user
    Route::post('/like-feed/{recipient}/{sender}/{feed}', [LikesController::class, 'like_feed'])->name('like.feed');
    Route::post('/like-comment/{recipient}/{sender}/{comment}', [LikesController::class, 'like_comment'])->name('like.comment');
    // route comment for user
    Route::resource('/comment', CommentsController::class);
    // route create question
    Route::post('/store_question', [QuestionsAnswersController::class, 'store_question'])->name('store.question');
    // route create and update answer
    Route::post('/store_answer', [QuestionsAnswersController::class, 'store_answer'])->name('store.answer');

});
Route::middleware(['auth', 'role:admin'])->group(function () {
    // route for admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('/admin/kategori-komunitas', ComunityCategoriesController::class);
    Route::get('/admin/approval-questions', [ApprovalAdminController::class, 'index_approval_questions'])->name('index.approval.questions');
    Route::delete('/admin/tolak-pertanyaan/{id}', [QuestionsAnswersController::class, 'destroy_question'])->name('block.question');
    Route::put('/admin/terima-pertanyaan/{model}', [ApprovalAdminController::class, 'accept_approval_question'])->name('accept.question');
});
