<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'creation_date' => 'required|date',
            "sector_id"=>"required|exists:sectors,id",
           // "doc_official" => "required|file|mimes:pdf|max:204800",
            "contact"=>"required|string",
            'email' => 'required|email',
            "country_id"=>"required|exists:countries,id",
            "linkedin"=>"nullable",
            "web_site"=>"nullable",
            "fb_page"=>"nullable",
        ];
    }
}
