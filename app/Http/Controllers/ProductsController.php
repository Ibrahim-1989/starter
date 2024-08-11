<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductsController extends Controller
{
    //
    public function __construct(){
        
    }
    public function index(){
        $products = Product::select(
            "id",
            'name_'. LaravelLocalization::getCurrentLocale() . ' as name',
            'description_'. LaravelLocalization::getCurrentLocale() . ' as description',
            'price',
            'image'
        )->get();
        return view('Products.all', compact('products'));
    }

    public function create(){
        return view('Products/Create');
    }

    public function store(ProductsRequest $request){
        Product::create(
            [
            'name_ar'=> $request->name_ar,
            'name_en'=> $request->name_en,
            'price'=> $request->price,
            'description_ar'=> $request->description_ar,
            'description_en'=> $request->description_en,
            'image'=> $request->image,
            ]
        );
        return redirect()->back()->with('success','تم إضافة العرض بنجاح');
    }

    public function delete($id){
        if($id != 0){
            Product::findOrFail($id)->delete();
        }
        return redirect()->back()->with('success','Deleted Sucessfully');
    }
}


