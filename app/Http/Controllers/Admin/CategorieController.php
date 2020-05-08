<?php

namespace App\Http\Controllers\Admin;

use App\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::orderBy('created_at','desc')->withCount(['subcategories','products'])->get();
        return view('admin.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            "categories"    => "required|array|min:1",
            "categories.*"  => "required|string|regex:/^[a-zA-Z\é\è\à\ê\â\î\ô\û\s+]+$/u|distinct|min:1",
        ],[
            'categories.required' => 'Le nom de categorie est obligatoire!',
            'categories.*.distinct' => 'Les categories doit être distinctes!',
            'categories.*.regex' => 'Les categories doit pas contenir les caractères speciaux!',
        ]);

        foreach($request->categories as $categorie){
            $newCategorie = new Categorie;
            $newCategorie->name = $categorie;
            $newCategorie->slug = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities(preg_replace('/\s+/','-',trim($categorie)), ENT_QUOTES, 'UTF-8'))), ' '));
            
            $newCategorie->save();
        }
        
        return redirect('/admin/categories')->withSuccess('Les categories ont été ajoutés avec succés!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "editedCategorie"  => "required|string|regex:/^[a-zA-Z\é\è\à\ê\â\î\ô\û\s+]+$/u|distinct",
        ],[
            'editedCategorie.required' => 'Le nom de categorie est obligatoire!',
            'editedCategorie.regex' => 'Le nom de categorie doit pas contenir des caractères speciaux!',
            'editedCategorie.distinct' => 'Les catégories doit être distinctes!',
        ]);

        $editedCategorie = Categorie::findOrFail($id);
        $editedCategorie->name = $request->editedCategorie;
        $editedCategorie->slug = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities(preg_replace('/\s+/','-',trim($request->editedCategorie)), ENT_QUOTES, 'UTF-8'))), ' '));
        $editedCategorie->save();

        return response()->json(['edited categorie'=>$editedCategorie,'message'=>'La catégorie a été modifié avec success!'],200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect('/admin/categories')->withSuccess('La catégorie a été supprimé avec succés');
    }
}
