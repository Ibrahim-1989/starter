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

    public function getAll(){
        $offers = Offer::select('id',
        'price',
        'name_'. LaravelLocalization::getCurrentLocale() . 'as Name',
        'details_'. LaravelLocalization::getCurrentLocale() . 'as Details',
        )->get();
        return view('offers.all', compact('offers'));
    }
    
    public function GetAllOffers(){
        $getAllOffers = Offer::get();
        return $getAllOffers;
    }

    public function storeOffer1(){
        Offer::create([
            'name'=> 'Name Offer 3',
            'price'=> 5000,
            'details'=> 'Offer Details',
        ]);
    }

    public function Create(){
        return view(LaravelLocalization::setLocale().'offers/Create');
    }

    public function NewOffer(OfferRequest $request){
        // $rules = $request->OffersRules();
        // $messages = $this->OfferMessages();
        // $validate = Validator::make($request->all(), $rules, $messages);

        // if($validate->fails()){
        //     return redirect()->back()->withErrors($validate)->withInput($request->all());
        // }
        
        Offer::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'details'=> $request->details,
        ]);
        return redirect()->back()->with('success','تم إضافة العرض بنجاح');
    }

    
    
}
