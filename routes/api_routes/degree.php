<?php
Route::resource('degrees',\App\Http\Controllers\Degree\DegreeController::class)->only("index");
Route::resource('user-degrees',\App\Http\Controllers\Degree\UserDegreeController::class);
