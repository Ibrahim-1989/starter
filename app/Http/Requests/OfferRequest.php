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
            'name.required'=> trans('messages.Offer Name Required'),
            'name.unique'=> trans('messages.Offer Name Must Be Unique'),
            'name.max'=> trans('messages.Offer Name Max'),
            'price.required'=>  trans('messages.Offer Price Required'),
            'price.numeric'=> trans('messages.Offer Price must be Numbers Only'),
            'details.required'=> trans('messages.Offer Details Is Required'),
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|unique:Offers,name|max:100',
            'price'=> 'required|numeric',
            'details'=> 'required',
        ] ;
    }
}
