<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // Get all the published products
    public function index()
    {
        $products = Product::published()->with(['category','subcategory'])->get();
        return response()->json(compact('products'),200);
    }


    // Show suggestions in (Product page)
    public function suggestions($subcategory)
    {
        $getSubcategory = Subcategory::find($subcategory);
        $products = $getSubcategory->products()->published()->limit(4)->get();
        return response()->json(compact('products'),200);
    }

    // Increase products sales after a successful order
    public function productSales(Request $request)
    {
        // dd($request->products);
        foreach($request->products as $product){
            $retrieved = Product::find($product['id']);
            $retrieved->sales++;
            $retrieved->save();
        }

        return response()->json(['Les ventes de produits mis à jour!'],200);
    }

}
