<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $passwordRules = 'min:8|max:100';
        $rules = [
            
            'name' => 'required|regex:/^[\p{L} ]+$/u|max:50|min:2',
            'email' => 'required|email|min:2|max:100|unique:users',
        ];

        if ($this->method() == 'POST') {
            $rules['password'] = $passwordRules . "|required";

        }

        if ($this->method() == 'PUT') {
            $rules['email'] = $rules['email'] . ",email," . $this->id;
        
            if ($this->password) {
                $rules['password'] = $passwordRules;
            }
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'password.min' => trans('password_should_be_at_least_8_numpers_or_letters'),
            'password.required' => trans('password_required'),
        ];
    }
}

