<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::resource('posts', PostController::class)->except('edit','create');
});

Route::post('/login', [LoginController::class,'authenticate']);

