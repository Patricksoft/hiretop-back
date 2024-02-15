<?php

namespace App\Traits;

use App\Models\Identity;
use App\Models\User;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

trait IdentityTrait
{
    public function indexIdentity($user_id){
        return Identity::with("country")->where("user_id",$user_id)->first();
    }


    public function saveIdentityTalent($request)
    {
        $data = $request->all();
        unset($data["cv_file"]);
        if ($request->cv) {
            $data["cv"] = uploadFile($request->cv, "cv");
        }
        $data["user_id"] = getApiConnectedUser()->id;
        $oldIdentity = Identity::where("user_id",getApiConnectedUser()->id)->first();
        if ($oldIdentity==null) {
            $oldIdentity =  Identity::create($data);
        }else{
            Identity::find($oldIdentity->id)->update($data);
        }
        return $oldIdentity;
    }
}
