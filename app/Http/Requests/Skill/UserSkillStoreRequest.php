<?php

namespace App\Http\Requests\Skill;

use Illuminate\Foundation\Http\FormRequest;

class UserSkillStoreRequest extends FormRequest
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
            "skill_id"=>"required|exists:skills,id",
            "year_exp"=>"required|integer|min:1",
        ];
    }
}
