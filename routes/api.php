<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\AdminController;
use App\http\Controllers\JwtAuthController;

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('user', [UserController::class,'index']);
    Route::post('user', [UserController::class,'store']);
    Route::get('user/{id}', [UserController::class,'show']);
    Route::patch('user/{id}', [UserController::class,'update']);
    Route::delete('user/{id}', [UserController::class,'destroy']);

    Route::get('post', [PostController::class,'index']);
    Route::get('userpost', [PostController::class,'currentUser']);
    Route::post('post', [PostController::class,'store']);
    Route::get('post/{id}', [PostController::class,'show']);
    Route::patch('post/{id}', [PostController::class,'update']);
    Route::delete('post/{id}', [PostController::class,'destroy']);

    Route::get('comment', [CommentController::class,'index']);
    Route::post('comment', [CommentController::class,'store']);
    Route::get('comment/{id}', [CommentController::class,'show']);
    Route::patch('comment/{id}', [CommentController::class,'update']);
    Route::delete('comment/{id}', [CommentController::class,'destroy']);

    Route::get('statics', [AdminController::class,'statics']);
    Route::get('statics/users/{id}', [AdminController::class,'UsersInfo']);
    Route::patch('update/{type}/{id}', [AdminController::class,'update']);
    Route::delete('delete/{type}/{id}', [AdminController::class,'delete']);
});
Route::post('register',[JwtAuthController::class,'register']);
Route::post('login',[JwtAuthController::class,'login']);
Route::post('logout',[JwtAuthController::class,'logout']);
