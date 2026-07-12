<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TracerPublicController extends Controller
{
    public function landing(){
        return view('tracer.landing');
    }

    public function form(){
        return view('tracer.form');
    }

    public function submit(Request $request){

    }

    public function thankyou(){
        return view('tracer.thankyou');
    }
}
