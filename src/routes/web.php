<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [ItemController::class, 'index']);
Route::get('/search', [ItemController::class, 'search']);
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
Route::post('/item/{id}/comment', [CommentController::class, 'comment']);
Route::get('/recommend', [ItemController::class, 'index']);



Route::middleware('auth')->group(function () {
    Route::get('/mypage/profile', [UserController::class, 'profile']);
    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
    Route::get('/profile', [UserController::class, 'profile']);
    Route::patch('/mypage/update', [UserController::class, 'update']);
    Route::post('/item/{id}/likes', [LikeController::class, 'likeItem']);
    Route::post('/item/{id}/dislikes', [LikeController::class, 'dislikeItem']);
    Route::get('/mylist', [LikeController::class, 'myList']);
});


Route::get('/', [ItemController::class, 'indexLogin']);