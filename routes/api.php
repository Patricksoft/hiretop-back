<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

@include_once "api_routes/auth.php";
@include_once "api_routes/location.php";
@include_once "api_routes/identity.php";
@include_once "api_routes/degree.php";
@include_once "api_routes/sector.php";
@include_once "api_routes/experience.php";
@include_once "api_routes/skill.php";
@include_once "api_routes/setting.php";
@include_once "api_routes/company.php";
@include_once "api_routes/offer.php";
@include_once "api_routes/discussion.php";
@include_once "api_routes/statistic.php";
