<?php
Route::resource('offers',\App\Http\Controllers\Offer\OfferController::class);
Route::resource('applies',\App\Http\Controllers\Apply\ApplyController::class);
Route::resource('applies-search',\App\Http\Controllers\Apply\ApplySearchController::class);
Route::resource('process-apply',\App\Http\Controllers\Apply\ApplyProcessController::class);
