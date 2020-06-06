<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{

    // Show product page (using slug)
    public function show($slug){
        $product = Product::where('slug',$slug)->with('subcategory')->first();
        $product->views++;
        $product->save();

        return view('app.productPage',compact(['product']));
    }

}
