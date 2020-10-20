<?php

namespace App\Http\Requests\Admin;

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

            'name'        => 'required|max:50|min:2',
            'email'       => 'required|email|min:2|max:100|unique:users',
            
            
        ];

        if ($this->method() == 'POST') {
            $rules['password'] = $passwordRules . "|required";

        }

        if ($this->method() == 'PUT') {
            $rules['email'] = $rules['email'] . ",email," . $this->id;
            $rules['password'] = $rules['password'] . ",password," . $this->id;

            if ($this->password) {
                $rules['password'] = $passwordRules;
            }
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'password.min' => trans('يجب ان لا تقل كلمة المرور عن ٨ احرف '),
            'password.required' => trans(' ادخل كلمة مرور'),
            'name.required' => trans('ادخل الاسم'),
            'email.required' => trans('ادخل بريد الكتروني '),
            'phone.required' => trans('ادخل رقم الهاتف  '),
            'area_id.required' => trans('قم باختيار المنطقة'),
            'image.required'   => trans('قم بادخل صورة البطاقة'),
            'address.required' => trans('قم بادخل العنوان'),
        ];
    }
}

