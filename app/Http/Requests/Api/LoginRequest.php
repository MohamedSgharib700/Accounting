<?php

namespace App\Http\Requests\Api;

// use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'       => 'required',
            'email'            => 'required|email',
         

        ];
    }

}
