<?php
Route::resource('countries',\App\Http\Controllers\Location\CountryController::class);
Route::get('states/{country_id}',[\App\Http\Controllers\Location\StateController::class,"index"]);
Route::get('cities/{state_id}',[\App\Http\Controllers\Location\CityController::class,"index"]);
