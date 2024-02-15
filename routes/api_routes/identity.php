<?php
Route::resource('info-account',\App\Http\Controllers\Identity\IdentityController::class)->only("index","store");
