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
            'name' => 'required',
            'description' => 'required',
            'count' => 'required|min:0',
            'price' => 'required|min:0|numeric',
            'image1' => 'image:jpg,png',
            'image2' => 'image:jpg,png',
            'image3' => 'image:jpg,png',
        ];
    }
}
