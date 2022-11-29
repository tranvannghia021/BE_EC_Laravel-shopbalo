<?php

namespace App\Http\Requests\Client\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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

            'customer_id' => "required",
            'staff_id'  => "required",
            'address_delivery'  => "required",
            'discount_id'  => "required",
            'status'  => "required",
            'discount_value'  => "required",
            'total_price'  => "required",
        ];
    }
}
