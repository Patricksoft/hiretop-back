<?php

namespace App\Traits;

use App\Models\Company;
use App\Models\Identity;
use App\Models\Presentation;
use App\Models\User;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

trait CompanyTrait
{
    public function indexCompany($user_id){
        return Company::with("country","sector")
            ->where("user_id",$user_id)->first();
    }

    public function saveCompany($request)
    {
        $data = $request->all();
        unset($data["doc_official"]);
        unset($data["doc_official_file"]);
        unset($data["logo"]);
        unset($data["logo_file"]);

        if ($request->hasFile('doc_official')) {
            $data["doc_official"] = uploadFile($request->doc_official, "doc_official");
        }
        if ($request->hasFile('logo')) {
            $data["logo"] = uploadFile($request->logo, "logo");
        }

        $data["user_id"] = getApiConnectedUser()->id;
        return  Company::updateOrCreate(
            [
                'user_id' => getApiConnectedUser()->id
            ],
            $data,
        );
    }

    public function indexCompanyDetail(){
       $company_id = getApiConnectedUser()->load("company")->company->id;
        return Presentation::where("company_id",$company_id)->first();
    }

    public function saveCompanyDetail($request)
    {
        $data = $request->all();
        $data["company_id"] = getApiConnectedUser()->load("company")->company->id;
        return  Presentation::updateOrCreate(
            [
                'company_id' => $data["company_id"]
            ],
            $data,
        );
    }


}
