<?php
Route::post('register',[\App\Http\Controllers\Auth\RegisterController::class,"store"]);
Route::post('validation/account',[\App\Http\Controllers\Auth\UserValidationController::class,"store"]);
Route::resource('user-auth',\App\Http\Controllers\Auth\AuthController::class);
Route::resource('users',\App\Http\Controllers\User\UserController::class);
