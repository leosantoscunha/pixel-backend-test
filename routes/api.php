<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| Please make BLOG & COMMENT CRUD ROUTES
*/

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blogs.all');
    Route::get('/{blog}', [BlogController::class, 'show'])->name('blogs.show');
    Route::post('/{blog}/comment', [CommentController::class, 'store'])->name('blogs.store.comment');
});

Route::prefix('comment')->group(function () {
    Route::put('/{comment}', [CommentController::class, 'update'])->name('blogs.update.comment')->missing(function () {
        return response()->json(['errors' => ['message' => 'Comment not fount']], 404);
    });

    Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('blogs.delete.comment')->missing(function () {
        return response()->json(['errors' => ['message' => 'Comment not fount']], 404);
    });
});
