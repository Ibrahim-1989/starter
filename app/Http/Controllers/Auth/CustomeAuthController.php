<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomeAuthController extends Controller
{
    public function Index(){
        return view('CustomeAuth.Index');
    }
}
