<?php

namespace App\Http\Controllers\Admin;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Subcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategorie::orderBy('created_at','desc')->with('categorie')->withCount('products')->get();
        return view('admin.subcategories.index',['subcategories'=>$subcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.subcategories.create',['categories'=>$categories]);
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
            "subcategories"    => "required|array|min:1",
            "subcategories.*"  => "required|string|regex:/^[a-zA-Z\é\è\à\ê\â\î\ô\û\s+]+$/u|distinct|min:1",
            "categorie"    => "required|integer",
        ],[
            'subcategories.required' => 'Le nom de sous-categorie est obligatoire!',
            'subcategories.*.regex' => 'Le nom de categorie doit pas contenir des caractères speciaux!',
            'categorie' => 'Le categorie est obligatoire!',
        ]);
        
        foreach($request->subcategories as $subcategorie){
            $newSubcategorie = new Subcategorie;
            $newSubcategorie->name = $subcategorie;
            $newSubcategorie->slug = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities(preg_replace('/\s+/','-',trim($subcategorie)), ENT_QUOTES, 'UTF-8'))), ' '));
            $newSubcategorie->categorie_id = $request->categorie;
            
            $newSubcategorie->save();
        }
        

        return redirect('/admin/subcategories')->withSuccess('Les sous-catégories ont été ajoutés avec succés!');
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
            "editedSubcategorie"  => "required|string|regex:/^[a-zA-Z\é\è\à\ê\â\î\ô\û\s+]+$/u|distinct",
        ],[
            'editedSubcategorie.required' => 'Le nom de sous-catégorie est obligatoire!',
            'editedSubcategorie.regex' => 'Le nom de categorie doit pas contenir des caractères speciaux!',
            'editedSubcategorie.distinct' => 'Les sous-catégorie doit être distinctes!',
        ]);

        // if($validatedData->fails()){
        //     return response()->json(['error'=>'Invalid data!'],422);
        // }

        $editedSubcategorie = Subcategorie::findOrFail($id);
        $editedSubcategorie->name = $request->editedSubcategorie;
        $editedSubcategorie->slug = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities(preg_replace('/\s+/','-',trim($request->editedSubcategorie)), ENT_QUOTES, 'UTF-8'))), ' '));        
        $editedSubcategorie->categorie_id = $request->categorie_id;        
        $editedSubcategorie->save();

        return response()->json(['edited Subcategorie'=>$editedSubcategorie,'message'=>'La sous-catégorie a été modifié avec success!'],200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategorie = Subcategorie::findOrFail($id);
        $subcategorie->delete();
        return redirect('/admin/subcategories')->withSuccess('La sous-catégorie a été supprimé avec succés');
    }
}
