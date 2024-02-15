<?php
Route::resource('skills',\App\Http\Controllers\Skill\SkillController::class)->only("index");
Route::resource('user-skills',\App\Http\Controllers\Skill\UserSkillController::class);
