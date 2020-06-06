<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Subcategory;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories = Subcategory::all();
        return response()->json(compact('subcategories'),200);
    }

}
