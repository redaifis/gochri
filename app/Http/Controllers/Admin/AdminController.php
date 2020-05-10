<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Shipping;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    

    // --------- Dashboard

    public function index()
    {
        $orders = Order::orderBy('created_at','desc')->with('products')->take(5)->get();
        $products = Product::orderBy('created_at','desc')->take(5)->get();
        $users_count = User::all()->count();
        $orders_count = Order::all()->count();
        $products_count = Product::all()->count();
        return view('admin.dashboard',['orders' => $orders, 'products' => $products, 'users_count' => $users_count, 'orders_count' => $orders_count, 'products_count' => $products_count]);
    }


    // --------- Profile

    public function editProfile($id)
    {
        return view('admin.editProfile', ['profile'=>Auth::user()]);
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|min:3|max:80',
            'image' => 'image',
            'country' => 'string',
            'city' => 'string',
            'address' => 'string',
            'phone' => 'string|regex:/(06)[0-9]{8}/',
        ],[
            'name.max' => 'Le nom à depassé 80 caractères!',
            'name.min' => 'Le nom doit contenir au minumum 3 charactère!',
            'image.image' => 'Le photo doit etre un image!',
            'phone.regex' => 'Le numèro téléphone est invalide!',
        ]);

        $user = User::findOrFail($id);

        if($request->has('image')){
            if($user->image != 'default_profile.jpg'){
                File::delete(public_path('storage/images/profiles/'.$user->image));
            }
            $imageName = Str::random(10).'.'.$request->image->extension();
            $request->image->move(public_path('storage/images/profiles'),$imageName);
            $user->image = $imageName;
        }

        $user->name = Str::title($request->name);
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();

        return redirect('/admin/dashboard')->withSuccess('Le profil a été modifié avec succés!');
    }

    public function changePassword(Request $request, $id){
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json('Le mot de passe a été modifié!',200);
    }


    // --------- Settings

    public function settings(){
        return view('admin.settings.index');
    }

    public function shipping(){
        $shipping_methods = Shipping::orderByDesc('created_at')->get();
        return view('admin.settings.shipping', ['shipping_methods' => $shipping_methods]);
    }

    public function addShipping(Request $request){
        $method = new Shipping;
        $method->name = str::title($request->name);
        $method->price = $request->price;
        $method->delivery_time = $request->time;
        $method->save();
        return response()->json('Méthode ajoutés avec succés!',200);
    }

    public function deleteShipping($id){
        $method = Shipping::findOrFail($id);
        $method->delete();
        return response()->json('Méthode supprimé avec succés!',200);
    }

    public function payment(){
        return view('admin.settings.payment');
    }
}
