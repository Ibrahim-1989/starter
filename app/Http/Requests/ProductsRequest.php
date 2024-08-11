<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'name_ar'=> 'required|unique:products,name_ar|max:100',
            'name_en'=> 'required|unique:products,name_en|max:100',
            'price'=> 'required|numeric',
            'description_ar'=> 'required',
            'description_en'=> 'required',
        ] ;
    }
    public function messages(){
        return [
            'name_ar.required'=> __('messages.Product Arabic Name Required'),
            'name_ar.unique'=> __('messages.Product Arabic Name Must Be Unique'),
            'name_ar.max'=> __('messages.Product Arabic Name Max'),
            'name_en.required'=> __('messages.Product English Name Required'),
            'name_en.unique'=> __('messages.Product English Name Must Be Unique'),
            'name_en.max'=> __('messages.Product English Name Max'),
            'price.required'=> __('messages.Product Price Required'),
            'price.numeric'=> __('messages.Product Price must be Numbers Only'),
            'description_ar.required'=> __('messages.Product Arabic Description Is Required'),
            'description_en.required'=> __('messages.Product English Description Is Required'),
        ];
    }
}
