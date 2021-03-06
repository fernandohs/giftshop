<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserCreateRequest extends FormRequest
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
        return [
            "name"       => ['required'],
            "birth_date" => ['required'],
            "phone"      => ['nullable'],
            "city"       => ['required'],
            "state"      => ['required'],
            "street"     => ['required'],
            "zip_code"   => ['required'],
            "email"      => ['required', 'email', 'unique:users,email'],
            "is_admin"   => ['required', 'boolean'],
            "password"   => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(["messages" => $validator->errors(), "status" => 500], 500)
        );
    }
}
