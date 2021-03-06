<?php

namespace App\Http\Controllers\Api\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('created_at','desc')->withCount(['subcategories','products'])->get();
        return response()->json(['categories'=>$categories],200);
    }


    public function store(Request $request)
    {
        $request->validate([
            "name"    => "required|string|regex:/^[a-zA-Z\é\è\à\ê\â\î\ô\û\s+]+$/u|distinct|min:1",
        ],[
            'name.regex' => 'La catégorie doit pas contenir des caractères speciaux!',
        ]);

        $newCategory = new Category;
        $newCategory->name =  Str::title($request->name);
        if($request->hasFile('image')){
            $imageName = Str::random(10).'.'.$request->image->extension();
            if($request->image->move(public_path('storage/images/categories'),$imageName)){
                $newCategory->image = $imageName;
            }
        }
        $newCategory->slug =  Str::slug($request->name);

        $newCategory->save();

        return response()->json(['success'=>'La catégorie été ajoutés avec succés!'],200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "editedCategory"  => "required|string|regex:/^[a-zA-Z\é\è\à\ê\â\î\ô\û\s+]+$/u|distinct",
        ],[
            'editedCategory.required' => 'Le nom de categorie est obligatoire!',
            'editedCategory.regex' => 'Le nom de categorie doit pas contenir des caractères speciaux!',
            'editedCategory.distinct' => 'Les catégories doit être distinctes!',
        ]);

        $editedCategory = Category::findOrFail($id);
        $editedCategory->name = Str::title($request->editedCategory);
        $editedCategory->slug = Str::slug($request->editedCategory);
        $editedCategory->save();

        return response()->json(['success'=>'La catégorie a été modifié avec success!'],200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category->image !== 'default_category.png'){
            File::delete(public_path('storage/images/categories/'.$category->image));
        }
        $category->delete();
        return response()->json(['success'=>'La catégorie a été supprimé avec succés'],200);
    }
}
