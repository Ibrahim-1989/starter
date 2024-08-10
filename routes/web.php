<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Offercontroller;
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


// Route::namespace('App\Http\Controllers')->group(function () {
//     Route::get('Offers', [App\Http\Controllers\Offercontroller::class,'GetAllOffers'])->name('OfferList');
//     Route::get('create', [App\Http\Controllers\Offercontroller::class,'Create'])->name('CreateOffer');
//     Route::Post('NewOffer', 'Offercontroller@NewOffer')->name('NewOffer');
// });
Route::group(['prefix'=> 'Offers'],function(){
    Route::group(
        [
            'prefix'=> LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ],
        function () {

            Route::get('/Fillable', [Offercontroller::class, 'GetAllOffers']);

            //Route::get('store1', [Offercontroller::class, 'storeOffer1'])->name('storeOffer1');

            Route::get('create', [Offercontroller::class, 'Create'])->name('CreateOffer');

            Route::Post('NewOffer', [Offercontroller::class, 'NewOffer'])->name('NewOffer');
        });
});