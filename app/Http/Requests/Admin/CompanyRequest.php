<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            
            'name' => 'required|max:50|min:2',
            'image' => 'required',
        ];
    }else{

        $rules = [
            
            'name' => 'required|max:50|min:2',
        ];
    }

        // if ($this->method() == 'POST') {
        //     $rules['password'] = $passwordRules . "|required";

        // }

        if ($this->method() == 'PUT') {
            // $rules['email'] = $rules['email'] . ",email," . $this->id;
            // $rules['machine_code'] = $rules['machine_code'] . ",machine_code," . $this->id;
            // $rules['national_id_number'] = $rules['national_id_number'] . ",national_id_number," . $this->id;
            // if ($this->password) {
            //     $rules['password'] = $passwordRules;
            // }
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

