<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'image' => 'sometimes|required|file|image|mimes:jpeg,png,jpg|max:2048',
            'postalCode' => 'sometimes|nullable|required|string|regex:/^\d{3}-\d{4}$/|size:8',
            'name' => 'sometimes|nullable|required|max:20',
            'address' => 'sometimes|nullable|required',
            'building' => 'sometimes|nullable|required',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '画像ファイルを選択してください',
            'image.mines' => '画像ファイルは、jpeg、png、jpg形式としてください',
            'postalCode.required' => '郵便番号を入力してください',
            'postalCode.regex' => '郵便番号は「xxx-xxxx」の形式で入力してください',
            'postalCode.size' => '郵便番号は8文字で入力してください',
            'name.required' => 'ユーザー名を入力してください',
            'name.max' => 'ユーザー名は20文字以内で入力してください',
            'address.required' => '住所を入力してください',
            'building.required' => '建物を入力してください',
        ];
    }
}
