<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request){
        $search = $request->search;

        if($search == '') return response()->json(['products' => ''],200);

        $products = Product::where('name','LIKE','%'.$search.'%')->limit(5)->get();

        return response()->json(compact('products'),200);
    }

    public function advancedSearch(){

    }
}
