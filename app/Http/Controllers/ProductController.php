<?php

namespace App\Http\Controllers;

use App\Product;
use SEO;

class ProductController extends Controller
{

    // Show product page (using slug)
    public function show($slug){
        $product = Product::where('slug',$slug)->with('subcategory')->first();
        $product->views++;
        $product->save();

        SEO::setTitle($product->name);
        SEO::setDescription($product->description);

        return view('app.productPage',compact(['product']));
    }

}
