<?php

namespace App\Http\Requests\Experience;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceStoreRequest extends FormRequest
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
        return [
            'label' => 'required',
            'type_work' => 'required|in:full_time,part_time,independent,freelance,cdd,cdi,internship,study_contract,seasonal',
            "company"=>"required|string",
            "region_id"=>"required|exists:countries,id",
            'type_location' => 'required|in:on_site,afar,hybrid',
            "begin"=>"required|date",
            "end"=>"required|date|after_or_equal:begin",
            "current_post"=>"required|boolean",
            'sector_id' => 'required|exists:sectors,id',
            'description' => 'required|string',
        ];
    }
}
