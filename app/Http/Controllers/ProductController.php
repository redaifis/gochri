<?php

namespace App\Http\Controllers;

use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($slug){
        $product = Product::where('slug',$slug)->with('subcategory')->get();
        return view('app.productPage',compact(['product']));
    }
}
