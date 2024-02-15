<?php

namespace App\Traits;

use App\Models\Degree;
use App\Models\Identity;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserDegree;
use App\Models\UserSkill;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

trait SkillTrait
{
    public function indexSkill(){
        return Skill::all();
    }

    public function saveUserSkill($request)
    {
        $data = $request->all();
        $data["user_id"] = getApiConnectedUser()->id;
        return !isset($request->id) ? UserSkill::create($data) : UserSkill::find($request->id)->update($data);
    }

    public function indexUserSkill($user_id){
        return UserSkill::with("skill")
            ->where("user_id",$user_id)
            ->orderByDesc("created_at")->get();
    }


}
