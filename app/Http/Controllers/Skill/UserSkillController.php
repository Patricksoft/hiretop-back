<?php

namespace App\Http\Controllers\Skill;

use App\Http\Controllers\Controller;
use App\Http\Requests\Degree\UserDegreeStoreRequest;
use App\Http\Requests\Skill\UserSkillStoreRequest;
use App\Models\UserDegree;
use App\Models\UserSkill;
use App\Traits\DegreeTrait;
use App\Traits\SkillTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserSkillController extends Controller
{
    use SkillTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(){
        return response()->json($this->indexUserSkill(getApiConnectedUser()->id),Response::HTTP_OK);
    }

    public function store(UserSkillStoreRequest $request)
    {
        return response()->json($this->saveUserSkill($request),Response::HTTP_OK);
    }

    public function destroy($id){
        return UserSkill::findOrFail($id)->delete();
    }
}
