<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => 'api','prefix' => 'auth'], function() {
    Route::get('me', [ProfileController::class, 'me']);
    Route::post('logout', [UserController::class, 'logout']);
});
