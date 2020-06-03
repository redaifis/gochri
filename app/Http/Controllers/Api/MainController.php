<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shipping;
use App\Subcategory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getRessources(){
        $latestProducts = Product::orderByDesc('created_at')->limit(6)->get();
        // $popularCategories = Category::orderByDesc('views')->limit(10)->get();
        $recommandedProducts = Product::where('recommanded', true)->limit(8)->get();
        $promotions = Product::where('discount','>','0')->limit(10)->get();
        $categories = Category::with('subcategories')->get();
        return response()->json(compact(['latestProducts','recommandedProducts','promotions','categories']),200);
    }

    public function getShippingMethods(){
        $shipping_methods = Shipping::all();
        return response()->json(compact('shipping_methods'),200);

    }

}
