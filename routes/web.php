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


Route::group([
    'prefix'=> LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],function(){
    Route::group(['prefix'=> 'Offers'],function(){

        Route::get('all', [Offercontroller::class, 'index'])->name('offers.all');

        Route::get('create', [Offercontroller::class, 'Create'])->name('CreateOffer');

        Route::Post('store', [Offercontroller::class, 'store'])->name('store');

        Route::get('delete/{id}', [Offercontroller::class, 'delete'])->name('offers.delete');

        Route::get('edit/{id}', [Offercontroller::class,'edit'])->name('offers.edit');

        Route::put('update', [Offercontroller::class,''])->name('Offers.update');
    });
});