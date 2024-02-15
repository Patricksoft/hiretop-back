<?php

namespace App\Traits;


use App\Models\User;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{

    public function registerUser($request)
    {
        $code = rand(10000, 99999);

            Notification::route('mail', [
                $request->email => 'Inscription',
            ])->notify(new AlertAdmin([
                "title" => "Code de verification",
                "msg" =>"Votre code vérification HireTop est : ".$code
            ]));

        return User::create(
            [
                "name" => $request->username,
                "email" => $request->email,
                "type" => $request->type,
                "code" => $code,
                "password" => Hash::make($request->password),
            ]
        );
    }

    public function validationUser($request){
        $user = User::whereEmail($request->email)->whereCode($request->code)->first();
        if ($user){
            $user->code = null;
            $user->email_verified_at = now();
            $user->save();
        }
        return $user;
    }

    public function resetCodeUser($request){
        $user = User::wherePhone($request->phone)->where("country_id",$request->country_id)->first();
        if ($user){
            $code = rand(10000, 99999);
            $user->code = $code;
            $user->save();
            $country = Country::find($request->country_id);
            $message = sendSms($country->iso.$request->phone,"Your Transporter update password code is: ".$code);
            Log::info($message);
        }
        return $user;
    }

    public function resetPasswordUser($request){
        $user = User::wherePhone($request->phone)->where("country_id",$request->country_id)->whereCode($request->code)->first();
        if ($user){
            $user->code = null;
            $user->password = Hash::make($request->new_password);
            $user->save();
        }
        return $user;
    }

    public function resetPasswordUserWithOld($request){
        $user = User::wherePhone($request->phone)->where("country_id",$request->country_id)->first();
        if ($user!=null && Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return $user;
        }else{
            return null;
        }
    }

    public function getAllUser()
    {
        $datas = User::with("country", "roles", "permissions");
        return $datas->get();
    }


    public function updatePassword($request)
    {
        $user = getApiConnectedUser()->update([
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['message' => 'Mot de passe modifié avec succès'], 200);
    }

    public function logoutApi()
    {
        $user = getApiConnectedUser()->token()->revoke();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    public function userIndex($type){
        return User::with("identity")
            ->has("identity")
            ->where("type",$type)->get();
    }

}

