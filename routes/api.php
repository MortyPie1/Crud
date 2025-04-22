<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('posts', [PostController::class,'index']);
Route::post('posts', [PostController::class,'store']);
Route::patch('update/posts/{id}', [PostController::class,'update']);
Route::delete('/destroy/posts/{id}', [PostController::class,'destroy']);
Route::get('comments', [CommentController::class,'index']);
Route::post('comments', [CommentController::class,'store']);
Route::patch('update/comments/{id}', [CommentController::class,'update']);
Route::delete('/destroy/comments/{id}', [CommentController::class,'destroy']);
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');
