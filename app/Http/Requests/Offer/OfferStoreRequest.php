<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class OfferStoreRequest extends FormRequest
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
            "label" => "required|string",
            "country_id" => "required|exists:countries,id",
            "remunerations_min" => "required|integer|min:1",
            "remunerations_max" => "required|integer|min:1|after_or_equal:remunerations_min",
            'type_location' => 'required|in:on_site,afar,hybrid',
            'sector_id' => 'required|exists:sectors,id',
            "year_exp_min" => "required|integer|min:1",
            "year_exp_max" => "required|integer|min:1|after_or_equal:year_exp_min",
            'type_work' => 'required|in:full_time,part_time,independent,freelance,cdd,cdi,internship,study_contract,seasonal',
            "languages" => "required|array",
            "detail" => "required",
        ];
    }
}
