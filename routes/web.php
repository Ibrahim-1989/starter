<?php

use App\Http\Controllers\Auth\CustomeAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Offercontroller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\youtubeController;
use App\Http\Controllers\AJAXController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([
    'prefix'=> LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],function(){
    Route::group(['prefix'=> 'Offers'],function(){

        Route::get('/', [Offercontroller::class, 'index'])->name('offers.all');

        Route::get('create', [Offercontroller::class, 'Create']);

        Route::Post('store', [Offercontroller::class, 'store'])->name('OfferStore');

        Route::get('delete/{id}', [Offercontroller::class, 'delete'])->name('offers.delete');

        Route::get('edit/{id}', [Offercontroller::class,'edit']);

        Route::Post('update/{id}', [Offercontroller::class,'update'])->name('Offers.update');
    });
});

Route::group([
    'prefix'=> LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    Route::group(['prefix'=> 'Products'], function(){

        Route::get('/', [ProductsController::class, 'index'])->name('Products.all');

        Route::get('Create', [ProductsController::class, 'Create']);

        Route::Post('store', [ProductsController::class, 'store'])->name('ProductsStore');

        Route::get('edit/{id}', [ProductsController::class,'edit']);

        Route::Post('update/{id}', [ProductsController::class,'update'])->name('Products.update');

        Route::get('delete/{id}', [ProductsController::class, 'delete'])->name('Products.delete');
    });
});

Route::group([
    'prefix'=> LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function(){
    Route::get('getVideo', [youtubeController::class,'index'])->name('ViewVideo');
});

    Route::group(['prefix'=> 'Ajax-Offer','namespace'=> 'App\Http\Controllers'], function(){

        Route::get('/', [AJAXController::class, 'index'])->name('Ajax.all');

        Route::get('Create', [AJAXController::class, 'Create']);

        Route::Post('store', [AJAXController::class, 'store'])->name('Ajax-Offer.store');

        Route::get('edit/{id}', [AJAXController::class,'edit']);

        Route::Post('update/{id}', [AJAXController::class,'update'])->name('Ajax.update');

        Route::get('delete/{id}', [AJAXController::class, 'delete'])->name('Ajax.delete');
    });


    Route::get('IndexAuth',[CustomeAuthController::class, 'Index'])->middleware('authAdmin');
    