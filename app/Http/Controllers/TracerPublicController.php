<?php

namespace App\Http\Controllers;

use App\Models\FormSchema;
use Illuminate\Http\Request;

class TracerPublicController extends Controller
{
    public function landing(){
        $formActive = FormSchema::getActive() !== null;
        return view('tracer.landing', compact('formActive'));
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
