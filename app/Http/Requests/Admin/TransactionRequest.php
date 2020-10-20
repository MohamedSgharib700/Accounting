<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        $rules = [
            // 'mobile_number' => 'required|min:10|max:12|regex:/(0)[0-9\s-]{9}/',
            'name' => 'required|regex:/^[\p{L} ]+$/u|max:50|min:2',
            
        ];

        return $rules;
    }

}

