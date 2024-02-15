<?php

namespace App\Http\Requests\Identity;

use Illuminate\Foundation\Http\FormRequest;

class IdentityStoreRequest extends FormRequest
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
            "firstname" => "required",
            "lastname" => "required",
            "address" => "required",
            "birthday" => "required",
            "marital_status" => "required|in:single,married,widowed,divorced",
            'email' => 'required|email',
            "phone" => "required",
            "country_id" => "required|exists:countries,id",
            "linkedin" => "nullable",
            "cv" => "file|mimes:pdf|max:204800",
        ];
    }
}
