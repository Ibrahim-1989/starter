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

        Offer::create([
            'name_ar'=> $request->name_ar,
            'name_en'=> $request->name_en,
            'price'=> $request->price,
            'details_ar'=> $request->details_ar,
            'details_en'=> $request->details_en,
        ]);
        return redirect()->back()->with('success','تم إضافة العرض بنجاح');
    }
}
