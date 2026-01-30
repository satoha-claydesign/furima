<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;

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
Route::get('/item/{id}', [ItemController::class, 'show']);


Route::middleware('auth')->group(function () {
    Route::get('/mypage/profile', [UserController::class, 'profile']);
    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
    Route::get('/profile', [UserController::class, 'profile']);
    Route::patch('/mypage/update', [UserController::class, 'update']);
    Route::post('/item/{id}/likes', [LikeController::class, 'likeItem']);
    Route::post('/item/{id}/dislikes', [LikeController::class, 'dislikeItem']);
    Route::get('/item/{id}/comment', [CommentController::class, 'comment'])->name('item.show');
    Route::get('/purchase/{id}/address', [OrderController::class, 'address'])->name('purchase.index');
    Route::patch('/purchase/{id}/update', [OrderController::class, 'updateAddress']);
    Route::patch('/payment/{id}', [OrderController::class, 'payment']);
    Route::get('/purchase/{id}', [OrderController::class, 'purchase'])->name('purchase.index');
    Route::patch('/complete/{id}', [OrderController::class, 'complete']);
    Route::get('/sell', [ItemController::class, 'sell'])->name('item.sell');
    Route::post('/item/store', [ItemController::class, 'store']);
});


