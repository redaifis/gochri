<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shipping;

class MainController extends Controller
{
    public function getRessources(){

        $latestProducts = Product::published()->latest()->limit(6)->get();
        $recommandedProducts = Product::published()->recommanded()->limit(8)->get();
        $promotions = Product::published()->promotion()->limit(10)->get();
        $categories = Category::with('subcategories')->get();

        return response()->json(compact(['latestProducts','recommandedProducts','promotions','categories']),200);

    }

    public function getShippingMethods(){

        $shipping_methods = Shipping::all();
        return response()->json(compact('shipping_methods'),200);

    }

}
