<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SEO;

class AuthController extends Controller
{

    // Custom authentication (login & register)

    public function loginPage(){
        SEO::setTitle('Gochri - Connectez-vous page');
        return view('app.auth.loginPage');
    }

    public function registerPage(){
        SEO::setTitle('Gochri - Créer un nouveau compte');
        return view('app.auth.registerPage');
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return response()->json(['success' => 'Vous etes connecté avec succés'],200);
        }

        return response()->json(['error' => 'Email ou mots de passe est incorrecte!'],422);
    }

    public function register(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|min:3|max:50',
            'password' => 'required|confirmed:password_confirmation|min:8|max:50'
        ],
        [
            'email.email' => 'L\'email est incorrecte!',
            'name.min' => 'Le nom doit être au moins 3 characteres!',
            'name.max' => 'Le nom doit être au max 50 characteres!',
            'password.confirmed' => 'Les mots de passe ne correspond pas!',
            'password.min' => 'Le mots de passe doit être au moins 8 characteres!'
        ]);


        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return response()->json(['user' => $user, 'success' => 'Vous êtes inscrit avec succés!'],200);
    }

    public function logout(Request $request){
        Auth::logout();
        if($request->expectsJson()){
            return response()->json(['success' => 'Vous êtes deconnecté!'],200);
        }
        return redirect('/');
    }
}
