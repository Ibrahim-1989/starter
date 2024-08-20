<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Traits\OffetTraits;


class AJAXController extends Controller
{
    use OffetTraits;
    //
    public function __construct(){

    }
    public function index(){
        $offers = Offer::select('id',
        'price',
        'name_'. LaravelLocalization::getCurrentLocale() . ' as name',
        'details_'. LaravelLocalization::getCurrentLocale() . ' as details',
        )->get();
        return view('Ajax.all', compact('offers'));
    }


    public function Create(){
        return view('Ajax/Create');
    }


    public function store(Request $request){

        $file_name = $this-> saveImage($request->imge,'images/Ajax-Offer');
        
        $offer = Offer::create([
            'imge'=> $file_name,
            'name_ar'=> $request->name_ar,
            'name_en'=> $request->name_en,
            'price'=> $request->price,
            'details_ar'=> $request->details_ar,
            'details_en'=> $request->details_en,
        ]);
        if($offer)
        return response()->json([
            'status'=>true,
            'msg'=> 'تم الحفظ بنجاح'
            ]);
            else
            return response()->json([
            'status'=>false,
            'msg'=> 'فشل الحفظ'
            ]);
        //return redirect()->back()->with(['success', __('messages.Offer Added Sucessfully')]);
    }
}
