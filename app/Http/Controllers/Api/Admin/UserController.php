<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('id','!=',auth()->id())->orderBy('created_at','desc')->get();
        return response()->json(['users' => $users],200);
    }

    public function show($id)
    {
        $user = User::where('id','=',$id)->withCount('orders')->with('orders.products')->first();
        return response()->json(['user' => $user], 200);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => 'L\'utilisateur a été supprimé avec succés!'],200);
    }

    // Current Authenticated Admin User

    public function myProfile(){
        return response()->json(['profile' => Auth::user()],200);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:80',
            'country' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|regex:/^(06)[0-9]{8}+$/',
        ],[
            'name.required' => 'Le nom est obligatoire!',
            'country.required' => 'Le pays est obligatoire!',
            'city.required' => 'La ville est obligatoire!',
            'address.required' => 'L\'addresse est obligatoire!',
            'phone.required' => 'Le numéro de téléphone est obligatoire!',
            'name.max' => 'Le nom à depassé 80 caractères!',
            'name.min' => 'Le nom doit contenir au minumum 3 charactère!',
            'phone.regex' => 'Le numèro téléphone est invalide!',
        ]);

        $user = Auth::user();

        $user->name = Str::title($request->name);
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();

        return response()->json(['profile' => $user, 'success'=>'Le profil a été modifié avec succés!'],200);
    }

    public function updateProfileImg(Request $request){
        $request->validate([
            'image' => 'required|file|image|mimes:jpg,jpeg,png,svg',
        ],[
            'image.required' => 'L\'image est obligatoire!',
            'image.image' => 'Le photo doit etre un image!',
            'image.file' => 'Le photo doit etre un image!',
            'image.mimes' => 'Le photo doit etre un image de type: png, jpg, svg!',
        ]);

        $user = Auth::user();

        if($user->image != 'default_profile.jpg'){
            File::delete(public_path('storage/images/profiles/'.$user->image));
        }
        $imageName = Str::random(10).'.'.$request->image->extension();
        $request->image->move(public_path('storage/images/profiles'),$imageName);
        $user->image = $imageName;
        $user->save();

        return response()->json(['image' => $user->image, 'success'=>'Le profil a été modifié avec succés!'],200);

    }

    public function changePassword(Request $request){
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['success' => 'Le mot de passe a été modifié!'],200);
    }
}
