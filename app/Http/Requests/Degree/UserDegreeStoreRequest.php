<?php

namespace App\Http\Requests\Degree;

use Illuminate\Foundation\Http\FormRequest;

class UserDegreeStoreRequest extends FormRequest
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
            "intitule"=>"required|string",
            "school"=>"required|string",
            "begin"=>"required|date",
            "end"=>"required|date|after_or_equal:begin",
            "degree_id"=>"required|exists:degrees,id",
            'sector_id' => 'required|exists:sectors,id',
        ];
    }
}
