<?php

namespace App\Http\Requests\Admin\Rating;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => 'required',
            'product_id' => 'required',
            'point' => 'required|max:5|integer',
            'content' => 'required',
            'image' => 'required',
        ];
    }



    public function messages()
    {
        return [
            'customer_id.required' => 'Customer_id rating is required!',
            'product_id.required' => 'product_id rating is required!',
            'point.required' => 'Point rating is required!',
            'content.required' => 'Content rating is required!',
            'image.required' => 'Image rating is required!',

        ];
    }


    protected function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => $errors,
            ],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
