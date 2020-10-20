<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SupervisorRequest extends FormRequest
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
            'name'  => 'bail|required|max:50|min:2',
            'email' => '',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active'=>'integer',
            'password'=>''
        ];

        if ($this->method() == 'POST') {
            $rules['password'] = $passwordRules . "|required|confirmed";
            $rules['email'] = "required|email|min:2|max:100|unique:users";

        }

       if ($this->method() == 'PUT') {
            $rules['email'] =  Rule::unique('users')->ignore($this->id);
        }

        return  $rules;
    }


    public function messages()
    {
        return [
            'name.required' => trans('يجب ان تدخل الاسم'),
            'password.min' => trans('كلمه المرور يجب ان لا تقل عن 8 ارقام او احرف'),
            'password.required' => trans('يجب ان تدخل كلمه المرور'),
            'password.confirmed' => trans('تاكيد كلمه المرور غير متطابق'),
            'email.required' => trans('يجب ان تدخل البريد الالكتروني'),
            'email.unique' => trans('البريد الالكتروني مستخدم من قبل'),
        ];
    }
}
