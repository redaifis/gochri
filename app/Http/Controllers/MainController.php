<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('app.landingPage');
    }

    public function about(){
        return view('app.aboutPage');
    }

    public function contact(){
        return view('app.contactPage');
    }

    public function privacyPolicy(){
        return view('app.policyPage');
    }
}
