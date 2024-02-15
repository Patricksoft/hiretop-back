<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            "phone"=>"required|unique:users,phone",
            "country_id"=>"required|exists:countries,id",
            'role' => 'required|exists:roles,id',
        ];
    }


    public function messages()
    {
        return [
            'firstname.required' => 'Le champ nom est requis',
            'lastname.required' => 'Le champ prenoms est requis',
            'email.required' => 'Le champ email est requis',
            'password.required' => 'Le champ mot de passe est requis',
            'phone.required' => 'Le champ telephone est requis',
            'country_id.required' => 'Le champ pays est requis',
            'role_id.required' => 'Le champ role est requis',
        ];
    }
}
