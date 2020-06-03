<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchPage($type = '',$searchText = ''){

        if($type == 'category'){
            $category = Category::where('name','LIKE','%'.$searchText.'%')->first();
            $products = $category ? $category->products()->get() : Product::all();

        }elseif($type == 'subcategory') {
            $subcategory = Subcategory::where('name','LIKE','%'.$searchText.'%')->first();
            $products = $subcategory ? $subcategory->products()->get() : Product::all();
        }elseif($type == 'product') {
            $products = Product::where('name','LIKE','%'.$searchText.'%')->get();
        }else{
            $products = Product::inRandomOrder()->get();
        }
        return view('app.searchPage',['products' => $products, 'searchText' => $searchText]);
    }
}
