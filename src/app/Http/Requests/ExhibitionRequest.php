<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'price' => 'required|integer|min:0',
            'description' => 'required|max:255',
            'condition' => 'required',
            'allcategory_ids' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '商品画像ファイルを選択してください',
            'image.mines' => '画像ファイルは、jpeg、png、jpg形式としてください',
            'name.required' => '商品名を入力してください',
            'price.required' => '商品価格を入力してください',
            'price.integer' => '商品価格は半角数字で入力してください',
            'price.min' => '商品価格は0円以上で入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '商品説明は255文字以内で入力してください',
            'condition.required' => '商品の状態を選択してください',
            'allcategory_ids.required' => '商品カテゴリーを選択してください',
        ];
    }
}
