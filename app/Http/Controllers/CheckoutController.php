<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // public function checkout(){
    //     return view('checkout',['amount' => 100]);
    // }

    public function charge(Request $request){
        // dd($request);
        $total = $request->total * 100;
        $user = Auth::user();
        $charged = $user->charge($total,$request->id);
        return response()->json(compact('charged'),200);
    }

    public function thankYou(){
        return view('app.thankYou');
    }
}
