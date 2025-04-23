<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::get('posts', [PostController::class,'index']);
// Route::post('posts', [PostController::class,'store']);
// Route::patch('update/posts/{id}', [PostController::class,'update']);
// Route::delete('/destroy/posts/{id}', [PostController::class,'destroy']);
// Route::get('comments', [CommentController::class,'index']);
// Route::post('comments', [CommentController::class,'store']);
// Route::patch('update/comments/{id}', [CommentController::class,'update']);
// Route::delete('/destroy/comments/{id}', [CommentController::class,'destroy']);
// Route::get('comments', [UserController::class,'index']);
// Route::post('comments', [UserController::class,'store']);
// Route::patch('update/comments/{id}', [UserController::class,'update']);
// Route::delete('/destroy/comments/{id}', [UserController::class,'destroy']);




Route::get('user', [UserController::class,'index']);
Route::post('user', [UserController::class,'store']);
Route::get('user/{id}', [UserController::class,'show']);
Route::patch('user/{id}', [UserController::class,'update']);
Route::delete('user/{id}', [UserController::class,'destroy']);

Route::get('post', [PostController::class,'index']);
Route::post('post', [PostController::class,'store']);
Route::get('post/{id}', [PostController::class,'show']);
Route::patch('post/{id}', [PostController::class,'update']);
Route::delete('post/{id}', [PostController::class,'destroy']);

Route::get('comment', [CommentController::class,'index']);
Route::post('comment', [CommentController::class,'store']);
Route::get('comment/{id}', [CommentController::class,'show']);
Route::patch('comment/{id}', [CommentController::class,'update']);
Route::delete('comment/{id}', [CommentController::class,'destroy']);