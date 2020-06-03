<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{


    use AuthenticatesUsers;


    public function login(Request $request){

        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return response()->json(['success' => 'Vous etes connecté avec succés'],200);
        }

        return response()->json(['error' => 'Email ou mots de passe est incorrecte!'],422);
    }
}
