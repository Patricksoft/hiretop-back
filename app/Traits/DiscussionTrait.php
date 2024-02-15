<?php

namespace App\Traits;

use App\Models\Degree;
use App\Models\Discussion;
use App\Models\Identity;
use App\Models\Message;
use App\Models\User;
use App\Models\UserDegree;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

trait DiscussionTrait
{


    public function saveDiscussion($request)
    {
        $data = $request->all();
        $data["company_id"] = getApiConnectedUserCompany()->company->id;
        return Discussion::updateOrCreate($data, $data);
    }


    public function indexDiscussion()
    {
        if (getApiConnectedUser()->type == 'talent') {
            return Discussion::with("company")->where("user_id", getApiConnectedUser()->id)->get();
        } else {
            return Discussion::with("user.identity")->where("company_id", getApiConnectedUserCompany()->company->id)->get();
        }
    }

    public function indexMessage($request)
    {
        $discussion = Discussion::find($request->discussion_id);
        $user = getApiConnectedUser();
        if ($user->type=="talent"){
            $discussion->count_msg_unread_user= 0;
        }else{
            $discussion->count_msg_unread_company = 0;
        }
        $discussion->save();

        return Message::with("user.identity","user.company")
            ->where("discussion_id", $request->discussion_id)->get();
    }

    public function addMessage($request)
    {
        $data = $request->all();
        $user = getApiConnectedUser();
        $data["from_user_id"] = $user->id;
        $discussion = Discussion::with("user.identity","company")->find($request->discussion_id);

        if ($user->type=="talent"){
            $discussion->count_msg_unread_company++;
            Notification::route('mail', [
                $discussion->company->email => $discussion->company->name,
            ])->notify(new AlertAdmin([
                "title" => "HireTop - Message",
                "msg" => "Nouveau message sur Hiretop avec ". $discussion->user->identity->firstname . " " . $discussion->user->identity->lastname
            ]));
        }else{
            $discussion->count_msg_unread_user++;
            Notification::route('mail', [
                $discussion->user->identity->email =>  $discussion->user->identity->firstname . " " . $discussion->user->identity->lastname,
            ])->notify(new AlertAdmin([
                "title" => "HireTop - Message",
                "msg" => "Nouveau message sur Hiretop avec ".$discussion->company->name
            ]));
        }
        $discussion->save();

        return Message::create($data);
    }


}
