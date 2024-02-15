<?php

namespace App\Http\Requests\Offer;

use App\Models\Apply;
use Illuminate\Foundation\Http\FormRequest;

class ApplyProcessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $apply = Apply::with("process_apply")->findOrFail($this->apply_id);
        $process_apply = $apply->process_apply;

        switch ($this->step) {
            case null:
                return [
                    "msg" => "required|string",
                    "selection_interview_planning1" => "required|date",
                    "selection_interview_planning2" => "required|date|after:selection_interview_planning1",
                    "selection_interview_planning3" => "required|date|after:selection_interview_planning2",
                ];
            case "preselection":
                if ($process_apply->selection_interview_planning_selected == null) {
                    return [
                        "selection_interview_planning" => "required|date",
                    ];
                } else {
                    return [
                        "selection_decision" => "required|string",
                        "msg2" => "required|string",
                        "competency_interview_planning1" => "required|date",
                        "competency_interview_planning2" => "required|date|after:competency_interview_planning1",
                        "competency_interview_planning3" => "required|date|after:competency_interview_planning2",
                    ];
                }

            case "selection":
                if ($process_apply->competency_interview_planning_selected == null) {
                    return [
                        "competency_interview_planning_selected" => "required|date",
                    ];
                } else {
                    return [
                        "competency_interview_decision" => "required|string",
                        "msg3" => "required|string",
                    ];
                }
                break;

            case "competency_interview":
                if ($process_apply->reference_checking_decision == null) {
                    return [
                        "reference_checking_decision" => "required|string",
                        "msg4" => "required|string",
                    ];
                }
                break;

            case "reference_checking":
                if ($process_apply->job_offer_decision == null) {
                    return [
                        "job_offer_decision" => "required|string",
                        "msg5" => "required|string",
                    ];
                }
                break;
            case "job_offer":
                if ($process_apply->final_decision_decision == null) {
                    return [
                        "final_decision_decision" => "required|string",
                        "msg6" => "required|string",
                    ];
                }
                break;
        }
    }
}
