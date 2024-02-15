<?php

namespace App\Traits;

use App\Models\Degree;
use App\Models\Experience;
use App\Models\Identity;
use App\Models\User;
use App\Models\UserDegree;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

trait ExperienceTrait
{
    public function saveExp($request)
    {
        $data = $request->all();
        $data["user_id"] = getApiConnectedUser()->id;
        return !isset($request->id) ? Experience::create($data) : Experience::find($request->id)->update($data);
    }

    public function indexExp($user_id){
        return Experience::with("region","sector")
            ->where("user_id",$user_id)
            ->orderByDesc("begin")->get();
    }


}
