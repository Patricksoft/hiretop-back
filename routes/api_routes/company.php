<?php
Route::resource('companies',\App\Http\Controllers\Company\CompanyController::class)->only("index","store");
Route::resource('company-details',\App\Http\Controllers\Company\CompanyDetailController::class)->only("index","store");
