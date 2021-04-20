<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaleCreateRequest extends FormRequest
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
            'user_id'              => ['required', 'exists:users,user_id,id'],
            'details'              => ['required', 'array', 'min:1'],
            'details.*.price'      => ['required', 'numeric'],
            'details.*.quantity'   => ['required', 'numeric'],
            'details.*.product_id' => ['required', 'exists:products,product_id,id'],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(["messages" => $validator->errors(), "status" => 500], 500)
        );
    }
}
