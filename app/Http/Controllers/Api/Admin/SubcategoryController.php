<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories = Subcategory::orderBy('created_at','desc')->with('category')->withCount('products')->get();
        return response()->json(['subcategories' => $subcategories], 200);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "editedSubcategory"  => "required|string|regex:/^[a-zA-Z\é\è\à\ê\â\î\ô\û\s+]+$/u|distinct",
        ],[
            'editedSubcategory.required' => 'Le nom de sous-catégorie est obligatoire!',
            'editedSubcategory.regex' => 'Le nom de sous-categorie doit pas contenir des caractères speciaux!',
            'editedSubcategory.distinct' => 'Les sous-catégorie doit être distinctes!',
        ]);

        $editedSubcategory = Subcategory::findOrFail($id);
        $editedSubcategory->name = Str::title($request->editedSubcategory);
        $editedSubcategory->slug = Str::slug($request->editedSubcategory);
        $editedSubcategory->save();

        return response()->json(['success'=>'La sous-catégorie a été modifié avec success!'], 200);
    }


    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        return response()->json(['success' => 'La sous-catégorie a été supprimé avec succés'], 200);
    }
}
