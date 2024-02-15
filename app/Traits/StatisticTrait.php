<?php

namespace App\Traits;

use App\Models\Apply;
use App\Models\Degree;
use App\Models\Discussion;
use App\Models\Identity;
use App\Models\Offer;
use App\Models\ProcessApply;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserDegree;
use App\Models\UserSkill;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

trait StatisticTrait
{
    public function indexStatistic(){

        $user = getApiConnectedUser();
        if ($user->type=='talent'){
            return $this->talentStatistic();
        }else{
            return $this->companyStatistic();
        }

    }


    public function talentStatistic(){
        $applies = Apply::with("process_apply")
            ->where("user_id",getApiConnectedUser()->id);
        $count_applies = $applies->get()->count();
        $count_applies_preselection = $applies->has("process_apply")->get()->count();
        $count_applies_finalise = $applies->has("process_apply")
            ->whereHas("process_apply", function ($q){
                $q->where("step","final_decision");
            })->get()->count();

        $skills = Skill::withCount('offer_skills')->orderBy('offer_skills_count', 'desc')->get();

        $skills_filtered = $skills->filter(function ($item){
            return $item->offer_skills_count > 0;
        })->values();


        $user_skills = UserSkill::with("skill.offer_skills")->get();

        return [
            "count_applies"=>$count_applies,
            "count_applies_preselection"=>$count_applies_preselection,
            "count_applies_finalise"=>$count_applies_finalise,
            "skills"=>$skills_filtered,
            "user_skills"=>$user_skills
        ];
    }

    public function companyStatistic(){

        $offers = Offer::withCount('applies')
            ->where("company_id",getApiConnectedUserCompany()->company->id)->get();
        $applies_count = $offers->sum("applies_count");
        $discussions = Discussion::withCount("messages")
            ->where("company_id",getApiConnectedUserCompany()->company->id)
            ->get();
        $discussions_count = $discussions->sum("messages_count");

        $quality_applies =  (ProcessApply::all()->count() * 100) / $applies_count;

        return [
            "applies_count"=>$applies_count,
            "offres_count"=>$offers->count(),
            "interactions_count"=>$discussions_count,
            "quality_applies"=>$quality_applies
        ];
    }

}
