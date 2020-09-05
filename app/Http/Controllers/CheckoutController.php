<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    // checkout with stripe (cachier)
    public function charge(Request $request){
        $total = $request->total * 100;
        $user = Auth::user();
        $charged = $user->charge($total,$request->id);

        // Sending purchase email
        $data = array('name'=> auth()->user()->name);

        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to(auth()->user()->email, auth()->user()->name)->subject
                ('Votre achat est complétée! \nMerci.');
            $message->from('contact@gochri.com','Gochri');
        });

        return response()->json(compact('charged'),200);
    }


    // Thank you page (after making order & checkout)
    public function thankYou(){
        return view('app.thankYou');
    }
}
