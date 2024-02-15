<?php

namespace App\Traits;

use App\Models\Degree;
use App\Models\Identity;
use App\Models\User;
use App\Models\UserDegree;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

trait DegreeTrait
{
    public function indexDegree(){
        return Degree::all();
    }

    public function saveUserDegree($request)
    {
        $data = $request->all();
        $data["user_id"] = getApiConnectedUser()->id;
        return !isset($request->id) ? UserDegree::create($data) : UserDegree::find($request->id)->update($data);
    }

    public function indexUserDegree($user_id){
        return UserDegree::with("degree","sector")->where("user_id",$user_id)->orderByDesc("begin")->get();
    }


}
