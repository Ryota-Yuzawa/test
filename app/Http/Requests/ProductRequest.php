<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required | max:20',
            'company_name' => 'required | max:20',
            'price' => 'required | integer',
            'stock' => 'required | integer',
            'comment' => 'required | max:150',
            'img_path'=>'image | max:1024',
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'company_name' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫数',
            'comment' => 'コメント',
            'img_path'=>'商品画像',
        ];
    }

    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max' => ':attributeは:20字以内で入力してください。',
            'company_name.required' => ':attributeは必須項目です。',
            'company_name.max' => ':attributeは:20字以内で入力してください。',
            'price.required' => ':attributeは必須項目です。',
            'price.integer' => ':attributeは:数字で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.integer' => ':attributeは:数字で入力してください。',
            'comment.required' => ':attributeは必須項目です。',
            'comment.max' => ':attributeは:150字以内で入力してください。',
            'img_path.max' => 'attributeは1024以内の画像を選択してください。'
        ];
    }
}
