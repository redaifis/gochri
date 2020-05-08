<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function checkout(){
        return view('checkout',['amount' => 100]);
    }

    public function charge(Request $request){
        // dd($request);
        $user = Auth::user();
        $charged = $user->charge(1000,$request->id);
        return response()->json('Completed',200);
    }
}
