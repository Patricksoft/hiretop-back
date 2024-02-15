<?php

namespace App\Traits;

use App\Models\Apply;
use App\Models\Company;
use App\Models\ConfigFilter;
use App\Models\Degree;
use App\Models\Identity;
use App\Models\Offer;
use App\Models\OfferSkill;
use App\Models\ProcessApply;
use App\Models\User;
use App\Models\UserDegree;
use App\Notifications\AlertAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

trait OfferTrait
{
    public function indexOffer($request)
    {
        $data = Offer::with("country", "sector", "company.presentation", "offer_skills.skill");

        if (isset($request->company)) {
            $user = getApiConnectedUserCompany();
            $data->where("company_id", $user->company->id);
        }

        if (isset($request->slug)) {
            $data->where("slug", $request->slug);
        }

        if (isset($request->for_company)) {
            $data->with("applies");
        }

        if (isset($request->for_company_relation)) {
            $data->with("applies.user.identity.country",
                "applies.user.experiences.sector",
                "applies.user.experiences.region",
                "applies.user.user_degrees.degree",
                "applies.user.user_degrees.sector",
                "applies.user.user_skills.skill",
                "applies.user.filters",
                "applies.process_apply"
            );
        }

        if (isset($request->apply_id)) {
            $data->whereHas("applies", function ($q) use ($request) {
                $q->where("id", $request->apply_id);
            });
        }

        if (isset($request->by_apply_search)) {
            if (isset($request->regions) && sizeof($request->regions) > 0) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("filters", function ($q3) use ($request) {
                            foreach ($request->regions as $key => $value) {
                                if ($key === 0) {
                                    $q3->whereJsonContains('regions', $value);
                                } else {
                                    $q3->orWhereJsonContains('regions', $value);
                                }
                            }
                        });
                    });
                });
            }


            if (isset($request->sectors) && sizeof($request->sectors) > 0) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("filters", function ($q3) use ($request) {
                            foreach ($request->sectors as $key => $value) {
                                if ($key === 0) {
                                    $q3->whereJsonContains('sectors', $value);
                                } else {
                                    $q3->orWhereJsonContains('sectors', $value);
                                }
                            }
                        });
                    });
                });
            }


            if (isset($request->type_contracts) && sizeof($request->type_contracts) > 0) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("filters", function ($q3) use ($request) {
                            foreach ($request->type_contracts as $key => $value) {
                                if ($key === 0) {
                                    $q3->whereJsonContains('type_contracts', $value);
                                } else {
                                    $q3->orWhereJsonContains('type_contracts', $value);
                                }
                            }
                        });
                    });
                });
            }


            if (isset($request->type_location) && sizeof($request->type_location) > 0) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("filters", function ($q3) use ($request) {
                            foreach ($request->type_location as $key => $value) {
                                if ($key === 0) {
                                    $q3->whereJsonContains('type_location', $value);
                                } else {
                                    $q3->orWhereJsonContains('type_location', $value);
                                }
                            }
                        });
                    });
                });
            }


            if (isset($request->languages) && sizeof($request->languages) > 0) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("filters", function ($q3) use ($request) {
                            foreach ($request->languages as $key => $value) {
                                if ($key === 0) {
                                    $q3->whereJsonContains('languages', $value);
                                } else {
                                    $q3->orWhereJsonContains('languages', $value);
                                }
                            }
                        });
                    });
                });
            }


            if (isset($request->skills) && sizeof($request->skills) > 0) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("user_skills", function ($q3) use ($request) {
                            $q3->whereIn('skill_id', $request->skills);
                        });
                    });
                });
            }


            if (isset($request->degrees) && sizeof($request->skills) > 0) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("user_degrees", function ($q3) use ($request) {
                            $q3->whereIn('degree_id', $request->degrees);
                        });
                    });
                });
            }


            if (isset($request->year_exp_min) && isset($request->year_exp_max)) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("filters", function ($q3) use ($request) {
                            $q3->whereBetween('year_exp', [$request->year_exp_min, $request->year_exp_max]);
                        });
                    });
                });
            }

            if (isset($request->remunerations_min) && isset($request->remunerations_max)) {
                $data->whereHas("applies", function ($q) use ($request) {
                    $q->whereHas("user", function ($q2) use ($request) {
                        $q2->whereHas("filters", function ($q3) use ($request) {
                            $q3->whereBetween('remuneration', [$request->remunerations_min, $request->remunerations_max]);
                        });
                    });
                });
            }
        }

        if (isset($request->by_config)) {
            $user = getApiConnectedUser();
            $config = ConfigFilter::where("user_id", $user->id)->first();
            $data_request = $config->toArray();
            unset($data_request["id"]);
            unset($data_request["user_id"]);
            unset($data_request["created_at"]);
            unset($data_request["updated_at"]);
            $request->request->add($data_request);
            Log::info(["req" => $request->all()]);
        }

        if (isset($request->by_offer_search) || isset($request->by_config)) {
            if (isset($request->regions) && sizeof($request->regions) > 0) {
                $data->whereIn("country_id", $request->regions);
            }

            if (isset($request->sectors) && sizeof($request->sectors) > 0) {
                $data->whereIn("sector_id", $request->sectors);
            }

            if (isset($request->type_contracts) && sizeof($request->type_contracts) > 0) {
                $data->whereIn("type_work", $request->type_contracts);
            }
            if (isset($request->type_location) && sizeof($request->type_location) > 0) {
                $data->whereIn("type_location", $request->type_location);
            }
            if (isset($request->languages) && sizeof($request->languages) > 0) {
                foreach ($request->languages as $key => $value) {
                    if ($key === 0) {
                        $data->whereJsonContains('languages', $value);
                    } else {
                        $data->orWhereJsonContains('languages', $value);
                    }
                }
            }

            if (isset($request->skills) && sizeof($request->skills) > 0) {
                $data->whereHas("offer_skills", function ($q3) use ($request) {
                    $q3->whereIn('skill_id', $request->skills);
                });
            }

            if (isset($request->year_exp_max)) {
                $data->whereRaw('JSON_EXTRACT(year_exp, "$[0]") <= ?', [$request->year_exp_max])
                    ->whereRaw('JSON_EXTRACT(year_exp, "$[1]") >= ?', [$request->year_exp_max]);
            }

            if (isset($request->remunerations_min)) {
                $data->whereRaw('JSON_EXTRACT(interval_salary, "$[0]") <= ?', [$request->remunerations_min])
                    ->whereRaw('JSON_EXTRACT(interval_salary, "$[1]") >= ?', [$request->remunerations_min]);
            }
        }


        if ($request->checkIfRequest) {
            $user = getApiConnectedUser();
            $data->with("apply.process_apply");
            $data->with([
                "apply" => function ($q) use ($user) {
                    return $q->where("user_id", $user->id);
                }
            ]);
        }

        if ($request->onlyApplyer) {
            $data->has('apply');
        }

        return $data->orderByDesc("id")->paginate(10, ['*'], 'page ' . $request->page, $request->page);
    }

    public function saveOffer($request)
    {
        $data = $request->all();
        $data["user_id"] = getApiConnectedUser()->id;
        $data["company_id"] = getApiConnectedUser()->load("company")->company->id;
        $data["year_exp"] = [$request->year_exp_min, $request->year_exp_max];
        $data["interval_salary"] = [$request->remunerations_min, $request->remunerations_max];
        unset($data["year_exp_min"]);
        unset($data["year_exp_max"]);
        unset($data["remunerations_min"]);
        unset($data["remunerations_max"]);
        unset($data["skills"]);

        $id = null;
        if (!isset($request->id)) {
            $id = Offer::create($data)->id;
        } else {
            Offer::find($request->id)->update($data);
            $id = $request->id;
            OfferSkill::where("offer_id", $id)->delete();
        }
        Log::info($request->skills);
        for ($i = 0; $i < count($request->skills); $i++) {
            OfferSkill::create(["offer_id" => $id, "skill_id" => $request->skills[$i]]);
        }

        return $data;
    }


    public function applyOffer($request)
    {
        $offer = Offer::findOrFail($request->offer_id);
        $company = Company::findOrFail($offer->company_id);
        $data = $request->all();
        $user = getApiConnectedUserIdentity();
        $data["user_id"] = $user->id;
        Notification::route('mail', [
            $company->email => $company->name,
        ])->notify(new AlertAdmin([
            "title" => "Nouvelle candidature",
            "msg" => $user->firstname . " " . $user->lastname . " a postulé à l'offre " . $offer->label
        ]));
        return Apply::create($data);
    }


    public function applyProcess($request)
    {

        $apply = Apply::with("process_apply", "user.identity", "offer.company")->findOrFail($request->apply_id);
        $process_apply = $apply->process_apply;
        if ($process_apply == null) {
            $process_apply = ProcessApply::create(["apply_id" => $request->apply_id]);
        }

        switch ($request->step) {
            case null:
                $this->makePreselection($request, $process_apply, $apply);
                break;
            case "preselection":

                if ($process_apply->selection_interview_planning_selected == null) {
                    $this->chooseDateForSelection($request, $process_apply,$apply);
                } else {
                    $this->makeSelection($request, $process_apply,$apply);
                }
                break;

            case "selection":
                if ($process_apply->competency_interview_planning_selected == null) {
                    $this->chooseDateForCompetencyInterview($request, $process_apply,$apply);
                } else {
                    $this->makeCompetencyInterview($request, $process_apply,$apply);
                }
                break;

            case "competency_interview":
                if ($process_apply->reference_checking_decision == null) {
                    $this->makeReferenceChecking($request, $process_apply,$apply);
                }
                break;

            case "reference_checking":
                if ($process_apply->job_offer_decision == null) {
                    $this->makeJobOffer($request, $process_apply,$apply);
                }
                break;
            case "job_offer":
                if ($process_apply->final_decision_decision == null) {
                    $this->makeFinalDecision($request, $process_apply,$apply);
                }
                break;

        }

    }


    public function makePreselection($request, $process_apply, $apply)
    {
        $process_apply->update([
            "step" => "preselection",
            "preselection_at" => now(),
            "preselection_msg" => $request->msg,
            "selection_interview_planning" => [$request->selection_interview_planning1, $request->selection_interview_planning2, $request->selection_interview_planning3],
        ]);
        Notification::route('mail', [
            $apply->user->identity->email => $apply->user->identity->firstname . " " . $apply->user->identity->lastname,
        ])->notify(new AlertAdmin([
            "title" => "Préselection",
            "msg" => "Consulter votre résultat de présélection de l'offre : " . $apply->offer->label
        ]));
    }

    public function chooseDateForSelection($request, $process_apply, $apply)
    {
        $process_apply->update([
            "selection_interview_planning_selected" => $request->selection_interview_planning
        ]);
        Notification::route('mail', [
            $apply->offer->company->email => $apply->offer->company->name,
        ])->notify(new AlertAdmin([
            "title" => "Choix de date d'entretien de sélection ",
            "msg" => $apply->user->identity->firstname . " " . $apply->user->identity->lastname . " a choisit une date pour l'entretien de sélection de l'offre : " . $apply->offer->label
        ]));
    }


    public function makeSelection($request, $process_apply, $apply)
    {
        $process_apply->update($request->selection_decision == 'accepted' ?
            ["selection_decision" => $request->selection_decision,
                "selection_at" => now(),
                "selection_msg" => $request->msg2,
                "step" => "selection",
                "competency_interview_planning" => [$request->competency_interview_planning1, $request->competency_interview_planning2, $request->competency_interview_planning3],
            ] : ["selection_decision" => $request->selection_decision,
                "selection_msg" => $request->msg2,
            ]);
        Notification::route('mail', [
            $apply->user->identity->email => $apply->user->identity->firstname . " " . $apply->user->identity->lastname,
        ])->notify(new AlertAdmin([
            "title" => "Sélection",
            "msg" => "Consulter votre résultat de sélection de l'offre : " . $apply->offer->label
        ]));
    }

    public function chooseDateForCompetencyInterview($request, $process_apply, $apply)
    {
        $process_apply->update([
            "competency_interview_planning_selected" => $request->competency_interview_planning_selected
        ]);
        Notification::route('mail', [
            $apply->offer->company->email => $apply->offer->company->name,
        ])->notify(new AlertAdmin([
            "title" => "Choix de date d'entretien de compétence ",
            "msg" => $apply->user->identity->firstname . " " . $apply->user->identity->lastname . " a choisit une date pour l'entretien de compétence de l'offre : " . $apply->offer->label
        ]));
    }


    public function makeCompetencyInterview($request, $process_apply, $apply)
    {
        $process_apply->update($request->competency_interview_decision == 'accepted' ?
            [
                "competency_interview_decision" => $request->competency_interview_decision,
                "competency_interview_at" => now(),
                "competency_interview_msg" => $request->msg3,
                "step" => "competency_interview",
            ] : [
                "competency_interview_decision" => $request->competency_interview_decision,
                "competency_interview_msg" => $request->msg3,
            ]);
        Notification::route('mail', [
            $apply->user->identity->email => $apply->user->identity->firstname . " " . $apply->user->identity->lastname,
        ])->notify(new AlertAdmin([
            "title" => "Entretien de compétence",
            "msg" => "Consulter votre résultat suite à l'entretien de compétence de l'offre : " . $apply->offer->label
        ]));
    }


    public function makeReferenceChecking($request, $process_apply, $apply)
    {
        $process_apply->update($request->reference_checking_decision == 'accepted' ?
            [
                "reference_checking_decision" => $request->reference_checking_decision,
                "reference_checking_at" => now(),
                "reference_checking_msg" => $request->msg4,
                "step" => "reference_checking",
            ] : [
                "reference_checking_decision" => $request->reference_checking_decision,
                "reference_checking_msg" => $request->msg4,
            ]);
        Notification::route('mail', [
            $apply->user->identity->email => $apply->user->identity->firstname . " " . $apply->user->identity->lastname,
        ])->notify(new AlertAdmin([
            "title" => "Vérification des références",
            "msg" => "Consulter votre résultat après vérification de vos références pour l'offre : " . $apply->offer->label
        ]));
    }

    public function makeJobOffer($request, $process_apply, $apply)
    {
        $process_apply->update($request->job_offer_decision == 'accepted' ?
            [
                "job_offer_decision" => $request->job_offer_decision,
                "job_offer_at" => now(),
                "job_offer_msg" => $request->msg5,
                "step" => "job_offer",
            ] : [
                "job_offer_decision" => $request->job_offer_decision,
                "job_offer_msg" => $request->msg5,
            ]);
        Notification::route('mail', [
            $apply->offer->company->email => $apply->offer->company->name,
        ])->notify(new AlertAdmin([
            "title" => "Réponse suite à l'offre d'emploi",
            "msg" => $apply->user->identity->firstname . " " . $apply->user->identity->lastname . " a donné sa position suite à votre offre d'emploi pour : " . $apply->offer->label
        ]));
    }

    public function makeFinalDecision($request, $process_apply, $apply)
    {
        $process_apply->update($request->final_decision_decision == 'accepted' ?
            [
                "final_decision_decision" => $request->final_decision_decision,
                "final_decision_at" => now(),
                "final_decision_msg" => $request->msg6,
                "step" => "final_decision",
            ] : [
                "final_decision_decision" => $request->final_decision_decision,
                "final_decision_msg" => $request->msg6,
            ]);
        Notification::route('mail', [
            $apply->user->identity->email => $apply->user->identity->firstname . " " . $apply->user->identity->lastname,
        ])->notify(new AlertAdmin([
            "title" => "Décision finale",
            "msg" => "Consulter la décision finale de l'entreprise pour l'offre : " . $apply->offer->label
        ]));
    }


}
