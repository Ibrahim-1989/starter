<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class Offercontroller extends Controller
{
    //
    public function __construct(){

    }

    public function index(){
        $offers = Offer::select('id',
        'price',
        'name_'. LaravelLocalization::getCurrentLocale() . ' as name',
        'details_'. LaravelLocalization::getCurrentLocale() . ' as details',
        )->get();
        return view('offers.all', compact('offers'));
    }

    public function Create(){
        return view('offers/Create');
    }

    public function store(OfferRequest $request){
        // $rule = $request->rules();
        // $messages = $request->messages();

        // $validate = validator::make($request->all(), $rule, $messages);

        // if($validate->fails()){
        //     return redirect()->back()->withErrors($validate)->withInput($request->all());
        // }
        $file_extention = $request->imge->getClientOriginalExtension();
        $file_name = time().'.'.$file_extention;
        $path = 'images/offers';
        $request ->imge->move($path, $file_name);

        Offer::create([
            'imge'=> $file_name,
            'name_ar'=> $request->name_ar,
            'name_en'=> $request->name_en,
            'price'=> $request->price,
            'details_ar'=> $request->details_ar,
            'details_en'=> $request->details_en,
        ]);
        return redirect()->back()->with('success','تم إضافة العرض بنجاح');
    }
    public function edit($id){
        $offer = Offer::find($id);
        if($offer == null){
            return redirect()->back()->with('error','فشل فى إيجاد العرض');
        }
        $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price')->find($id);
        return view('offers.edit', compact('offer'));
    }
    
    public function update(Request $request, $id){
        
        $offer = Offer::find($id);
        if($offer == null){
            return redirect()->back()->with('error','فشل فى إيجاد العرض');
        }

        $rule = $this->editRules();
        $messages = $this->messages();
        $validate = validator::make($request->all(), $rule, $messages);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }
        
        $offer->update($request->all());
        return redirect()->back()->with('success','تم تحديدث العرض بنجاح');
    }

    public function delete($id){

        $offer = Offer::find($id);
        
        if($offer == null){
            return redirect()->back()->with('error','فشل فى إيجاد العرض');
        }

        $offer->delete();
        // if($id != 0){
        //     Offer::findOrFail($id)->delete();
        // }
        return redirect()->back()->with('success','Deleted Sucessfully');
    }

    public function editRules(){
        return $rules = [
            'name_ar'=> 'required|max:100',
            'name_en'=> 'required|max:100',
            'price'=> 'required|numeric',
            'details_ar'=> 'required',
            'details_en'=> 'required',
        ] ;
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
}
