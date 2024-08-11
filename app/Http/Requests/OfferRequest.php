<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
    
    public function messages(){
        return [
            'name_ar.required'=> __('messages.Offer Arabic Name Required'),
            'name_ar.unique'=> __('messages.Offer Arabic Name Must Be Unique'),
            'name_ar.max'=> __('messages.Offer Arabic Name Max'),
            'name_en.required'=> __('messages.Offer English Name Required'),
            'name_en.unique'=> __('messages.Offer English Name Must Be Unique'),
            'name_en.max'=> __('messages.Offer English Name Max'),
            'price.required'=> __('messages.Offer Price Required'),
            'price.numeric'=> __('messages.Offer Price must be Numbers Only'),
            'details_ar.required'=> __('messages.Offer Arabic Details Is Required'),
            'details_en.required'=> __('messages.Offer English Details Is Required'),
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name_ar'=> 'required|unique:Offers,name_ar|max:100',
            'name_en'=> 'required|unique:Offers,name_en|max:100',
            'price'=> 'required|numeric',
            'details_ar'=> 'required',
            'details_en'=> 'required',
        ] ;
    }
}
