<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShippingController extends Controller
{

    public function index()
    {
        $shipping_methods = Shipping::orderByDesc('created_at')->get();
        return response()->json(['shipping_methods' => $shipping_methods],200);
    }

    public function store(Request $request)
    {
        $method = new Shipping;
        $method->name = str::title($request->name);
        $method->price = $request->price;
        $method->delivery_time = $request->time;
        $method->save();
        return response()->json(['success' => 'Méthode ajoutés avec succés!'],200);
    }

    public function destroy($id)
    {
        $method = Shipping::findOrFail($id);
        $method->delete();
        return response()->json(['success' => 'Méthode supprimé avec succés!'],200);
    }
}
