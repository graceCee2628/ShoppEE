<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Auth::user()->is_admin=='0'){
            return redirect ('home');

        }
        else{
            return redirect ('admin');
        }
    }
    
}
