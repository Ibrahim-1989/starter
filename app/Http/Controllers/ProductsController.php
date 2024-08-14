<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Validator;
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

        $file_extention = $request->image->getClientOriginalExtension();

        $file_name = time().'.'.$file_extention;

        $path = 'images/Products';
        
        $request ->image->move($path, $file_name);

        Product::create(
            [
                'image'=>$file_name,
                'name_ar'=> $request->name_ar,
                'name_en'=> $request->name_en,
                'price'=> $request->price,
                'description_ar'=> $request->description_ar,
                'description_en'=> $request->description_en,
            ]
        );
        return redirect()->back()->with(['success',__('messages.Product Added Sucessfully')]);
    }

    public function edit($id){
        $product = Product::find( $id );
        if($product == null){
            return redirect()->back()->with(['error',__('messages.Product Not Found')]);
        }
        $product = Product::where('Id' ,$id)->first();
        return view('Products/edit', compact('product'));
    }


    public function update(Request $request, $id){
        $product = Product::find( $id );
        if($product == null){
            return redirect()->back()->with(['error',__('messages.Product Not Found')]);
        }

        $rule = $this->editRules();
        $messages = $this->messages();
        $validate = validator::make($request->all(), $rule, $messages);
        
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }

       // $product->update( $request->all() );
        $product->update([
                'name_ar'=> $request->name_ar,
                'name_en'=> $request->name_en,
                'price'=> $request->price,
                'description_ar'=> $request->description_ar,
                'description_en'=> $request->description_en,
        ]);
        return redirect()->back()->with(['success',__('messages.Product Updated Sucessfully')]);

    }

    public function delete($id){

       // $product = Product::find( $id );

        $product = Product::where('id',$id)->first();

        if(!$product){
            return redirect()->back()->with(['error',__('messages.Product Not Found')]);
        }

        $product->delete();

        // if($id != 0){
        //     Product::findOrFail($id)->delete();
        // }
        return redirect()->route('Products.all')->with(['success',__('messages.Deleted Sucessfully')]);
    }

    public function editRules()
    {
        return [
            'name_ar'=> 'required|max:100',
            'name_en'=> 'required|max:100',
            'price'=> 'required|numeric',
            'description_ar'=> 'required',
            'description_en'=> 'required',
        ] ;
    }

    public function messages(){
        return [
            'name_ar.required'=> __('messages.Product Arabic Name Required'),
            'name_ar.max'=> __('messages.Product Arabic Name Max'),
            'name_en.required'=> __('messages.Product English Name Required'),
            'name_en.max'=> __('messages.Product English Name Max'),
            'price.required'=> __('messages.Product Price Required'),
            'price.numeric'=> __('messages.Product Price must be Numbers Only'),
            'description_ar.required'=> __('messages.Product Arabic Description Is Required'),
            'description_en.required'=> __('messages.Product English Description Is Required'),
        ];
    }
}


