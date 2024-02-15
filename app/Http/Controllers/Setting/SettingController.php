<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\SettingStoreRequest;
use App\Http\Requests\Skill\UserSkillStoreRequest;
use App\Traits\SettingTrait;
use App\Traits\SkillTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
    use SettingTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(){
        return response()->json($this->indexUserSetting(getApiConnectedUser()->id),Response::HTTP_OK);
    }

    public function store(SettingStoreRequest $request)
    {
        return response()->json($this->saveUserSetting($request),Response::HTTP_OK);
    }
}
