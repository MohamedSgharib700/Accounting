<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PosRequest extends FormRequest
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
    if ($this->method() == 'POST') {
        $rules = [
            'user_id' => 'required',
            'image' => 'required',
            'machine_code' => 'required|numeric',
            'active' => 'required|numeric',
        ];
    }else{

        $rules = [
            'user_id' => 'required',
            'machine_code' => 'required|numeric',
        ];
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

