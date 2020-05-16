<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subcategory;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subcategories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategories.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "subcategories"  => "required|array",
            "subcategories.*"  => "required|string|regex:/^[a-zA-Z\é\è\à\ê\â\î\ô\û\s+]+$/u|distinct|min:1",
            "category"    => "required|integer",
        ],[
            'subcategories.*.required' => 'Le nom de sous-catégorie est obligatoire!',
            'subcategories.*.regex' => 'Le nom de sous-catégorie doit pas contenir des caractères speciaux!',
            'category' => 'Le categorie est obligatoire!',
        ]);
        
        foreach($request->subcategories as $subcategory){
            $newSubcategory = new Subcategory;
            $newSubcategory->name = Str::title($subcategory);
            $newSubcategory->slug = Str::slug($subcategory);
            $newSubcategory->category_id = $request->category;
            $newSubcategory->save();
        }
        
        return redirect('/admin/subcategories')->withSuccess('Les sous-catégories ont été ajoutés avec succés!');
    }

}
