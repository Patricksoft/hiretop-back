<?php
Route::resource('discussions',\App\Http\Controllers\Discussion\DiscussionController::class);
Route::resource('messages',\App\Http\Controllers\Discussion\MessageController::class);
