<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Categorie;
use App\Product;
use App\Subcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        $products = Product::with('categorie')->orderBy('created_at','desc')->get();
        return view('admin.products.index',['products' => $products, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Subcategorie::all();
        return view('admin.products.create',['subcategories' => $subcategories]);
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
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'image' => 'image|mimes:jpeg,jpg,png|nullable|max:1024',
            'subcategorie' => 'required',
            'price' => 'required|numeric',
            'discount' => 'integer',
            'vendor' => 'string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/|nullable',
            'stock' => 'integer|nullable',
            'status' => 'boolean|nullable',
        ],[
            'name.required' => 'Le nom est obligatoire!',
            'name.string' => 'Le nom doit être un chaîne de caractères!',
            'name.min' => 'Le nom doit contenir au minimum 3 caractères!',
            'description.required'  => 'Le description est obligatoire!',
            'description.image'  => 'Le fichier doit être un image!',
            'description.mimes'  => 'Le fichier doit être un image jpg, jpeg ou png!',
            'subcategorie.required'  => 'Le categorie est obligatoire!',
            'price.required'  => 'Le prix est obligatoire!',
            'discount.required'  => 'Le promotions doit être un nombre!',
            'vendor.regex'  => 'Le nom de fournisseur est invalide!',
        ]);

        $subcategorie = Subcategorie::findOrFail($request->subcategorie);
        $categorie = $subcategorie->categorie()->first();

        $product = new Product;
        
        if($request->hasFile('image')){
            $imageName = substr(str_shuffle(preg_replace('/\s+/','',trim($request->name))),0,10).'.'.$request->image->extension();
            if($request->image->move(public_path('storage/images/products'),$imageName)){
                $product->image = $imageName;
            }
        }
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->vendor = $request->vendor;
        if($request->has('discount')){
            $product->discount = $request->discount;
        }
        if($request->has('status')){
            $product->status = $request->status;
        }else{
            $product->status = 0;
        }
        $product->categorie_id = $categorie->id;
        $product->subcategorie_id = $subcategorie->id;
        $product->user_id = Auth::id();
        $product->save();

        return redirect('/admin/products')->withSuccess('Le produit a été ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategories = Subcategorie::all();
        $product = Product::where('id','=',$id)->with('subcategorie.categorie')->first();
        return view('admin.products.edit',['subcategories' => $subcategories,'product' => $product]);
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
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'image' => 'image|mimes:jpeg,jpg,png|nullable|max:1024',
            'subcategorie' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'integer|nullable',
            'vendor' => 'string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/|nullable',
            'stock' => 'integer|nullable',
            'status' => 'boolean',
        ],[
            'name.required' => 'Le nom est obligatoire!',
            'name.string' => 'Le nom doit être un chaîne de caractères!',
            'name.min' => 'Le nom doit contenir au minimum 3 caractères!',
            'description.required'  => 'Le description est obligatoire!',
            'description.image'  => 'Le fichier doit être un image!',
            'description.mimes'  => 'Le fichier doit être un image jpg, jpeg ou png!',
            'subcategorie.required'  => 'Le categorie est obligatoire!',
            'price.required'  => 'Le prix est obligatoire!',
            'discount.required'  => 'Le promotions doit être un nombre!',
            'vendor.regex'  => 'Le nom de fournisseur est invalide!',
        ]);

        $subcategorie = Subcategorie::findOrFail($request->subcategorie);
        $categorie = $subcategorie->categorie()->first();

        $product = Product::findOrFail($id);
        
        if($request->hasFile('image')){
            if($product->image !== 'default_product.png'){
                File::delete(public_path('storage/images/products/'.$product->image));
                $imageName = substr(str_shuffle(preg_replace('/\s+/','',trim($request->name))),0,10).'.'.$request->image->extension();
                if($request->image->move(public_path('storage/images/products'),$imageName)){
                    $product->image = $imageName;
                }

            }else{
                $imageName = substr(str_shuffle(preg_replace('/\s+/','',trim($request->name))),0,10).'.'.$request->image->extension();
                if($request->image->move(public_path('storage/images/products'),$imageName)){
                    $product->image = $imageName;
                }
                
            }
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->vendor = $request->vendor;
        if($request->has('discount')){
            $product->discount = $request->discount;
        }
        if($request->has('status')){
            $product->status = $request->status;
        }else{
            $product->status = 0;
        }
        $product->categorie_id = $categorie->id;
        $product->subcategorie_id = $subcategorie->id;
        $product->user_id = Auth::id();
        $product->save();

        return redirect('/admin/products')->withSuccess('Le produit a été modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if($product->image !== 'default_product.png'){
            File::delete(public_path('storage/images/products/'.$product->image));
        }

        $product->delete();
        
        return redirect('/admin/products')->withSuccess('Le produit a été supprimé avec succès!');
    }
}
