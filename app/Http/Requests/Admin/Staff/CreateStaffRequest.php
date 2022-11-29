<?php

namespace App\Http\Requests\Admin\Staff;

use Illuminate\Foundation\Http\FormRequest;

class CreateStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
            return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role_id'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'gender'=>'required',
            'phone'=>'required',
            'email'=>'required|email:rfc,dns',
            'password'=>'required|max:20|min:8',
            'avatar'=>'required',
            'address'=>'required',
            'created_date'=>'required',

        ];
    }

    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "required" => ":Attribute is required!"
        ];
    }
}
