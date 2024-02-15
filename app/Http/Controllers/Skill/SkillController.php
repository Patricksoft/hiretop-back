<?php

namespace App\Http\Controllers\Skill;

use App\Http\Controllers\Controller;
use App\Traits\SkillTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkillController extends Controller
{
    use SkillTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        return response()->json($this->indexSkill(),Response::HTTP_OK);
    }
}
