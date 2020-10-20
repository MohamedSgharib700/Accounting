<?php

namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
class ProfileRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'min:2|max:45|required',
            'phone'    => 'required|min:10|regex:/(0)[0-9\s-]{9}/',
            'email'    => 'required|email',
            'user_id'  => 'required'
        ];
    }


}
