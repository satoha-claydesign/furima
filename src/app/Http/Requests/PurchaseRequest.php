<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            //
            'payment' => 'sometimes|required',
            'order_postalCode' =>[
                'sometimes',
                'string',
                'regex:/^\d{3}-\d{4}$/',
                'size:8',
            ],
            'order_address' => 'sometimes|required',
            'order_building' => 'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            'payment.required' => '支払い方法を選択してください',
            'order_postalCode.required' => '郵便番号を入力してください',
            'order_postalCode.regex' => '郵便番号は「xxx-xxxx」の形式で入力してください',
            'order_postalCode.size' => '郵便番号は8文字で入力してください',
            'order_address.required' => '住所を入力してください',
            'order_building.required' => '建物を入力してください',
        ];
    }
}
