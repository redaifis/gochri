<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    // checkout with stripe (cachier)
    public function charge(Request $request){
        $total = $request->total * 100;
        $user = Auth::user();
        $charged = $user->charge($total,$request->id);
        return response()->json(compact('charged'),200);
    }


    // Thank you page (after making order & checkout)
    public function thankYou(){
        return view('app.thankYou');
    }
}
