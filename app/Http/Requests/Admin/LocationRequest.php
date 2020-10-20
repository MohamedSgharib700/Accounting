<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'lon' => 'required',
            'active' => 'required',
        ];

        if ($this->method() == 'PUT') {
            
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

