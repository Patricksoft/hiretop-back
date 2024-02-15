<?php

namespace App\Traits;

use App\Models\ConfigFilter;
use App\Models\Degree;
use App\Models\Identity;
use App\Models\User;
use App\Models\UserDegree;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

trait SettingTrait
{
    public function saveUserSetting($request)
    {
        $data = $request->all();
        $data["user_id"] = getApiConnectedUser()->id;
        $data["year_exp"] = $request->year_exp_max;
        $data["remuneration"] = $request->remunerations_min;
        unset($data["year_exp_max"]);
        unset($data["remunerations_min"]);
        return ConfigFilter::updateOrCreate(
            ["user_id"=>getApiConnectedUser()->id],
            $data
        );
    }

    public function indexUserSetting($user_id){
        return ConfigFilter::where("user_id",$user_id)->first();
    }


}
