<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Order;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function orders(){
        $orders = Order::where('user_id',Auth::id())->orderBy('created_at','desc')->withCount('products')->get();

        return response()->json(compact('orders'),200);
    }

    public function storeOrder(Request $request){
        $order = Order::create([
            'reference' => rand(100000,999999),
            'amount' => $request->amount,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'code_postal' => $request->code_postal,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method == "paypal" || $request->payment_method == "credit card" ? 1 : 0,
            'note' => $request->note,
            'paid_at' => now(),
            'user_id' => Auth::id(),
            'shipping_method_id' => $request->id,
        ]);

        $cartItems = collect($request->cartItems);

        foreach($cartItems as $item){
            $order->products()->attach([$item['id'] => ['quantity' => $item['qty']]]);
        }

        return response()->json(compact('order'),200);
    }

    public function orderProducts($orderId){
        $order = Order::find($orderId)->first();

        return response()->json(compact('order'),200);
    }

    public function wishlistProducts(){
        $wishlist = Wishlist::where('user_id',Auth::id())->first();
        if($wishlist != null){
            $wishlist = $wishlist->products()->get();
            return response()->json(compact('wishlist'),200);
        }
        return response()->json('Aucun produits a été trouvé!',200);
    }

    public function toggleWishlist($productId){
        $wishlist = Wishlist::firstOrCreate(['user_id' => Auth::id()]);
        $wishlist->products()->toggle($productId);
        return response()->json(compact('wishlist'),200);
    }

    public function me(){
        return response()->json(['profile' => Auth::user()],200);
    }

    public function modifyProfile(Request $request){
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

}
