<?php

namespace App\Http\Controllers\Api\Admin;

use App\Category;
use App\Subcategory;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{


    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->orderBy('created_at','desc')->get();
        return response()->json(['products' => $products, 'categories' => $categories], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'image' => 'image|mimes:jpeg,jpg,png|nullable|max:1024',
            'subcategory' => 'required',
            'price' => 'required|numeric',
            // 'discount' => 'integer|nullable',
            'vendor' => 'string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/|nullable',
            'stock' => 'integer|nullable',
            'status' => 'boolean|nullable',
        ],[
            'name.required' => 'Le nom est obligatoire!',
            'name.string' => 'Le nom doit être un chaîne de caractères!',
            'name.min' => 'Le nom doit contenir au minimum 3 caractères!',
            'description.required'  => 'Le description est obligatoire!',
            'image.image'  => 'Le fichier doit être un image!',
            'image.mimes'  => 'Le fichier doit être un image jpg, jpeg ou png!',
            'subcategory.required'  => 'La catégorie est obligatoire!',
            'price.required'  => 'Le prix est obligatoire!',
            // 'discount.integer'  => 'Le promotions doit être un nombre!',
            'vendor.regex'  => 'Le nom de fournisseur est invalide!',
        ]);

        $subcategory = Subcategory::findOrFail($request->subcategory);
        $category = $subcategory->category()->first();

        $product = new Product;

        if($request->hasFile('image')){
            $imageName = Str::random(10).'.'.$request->image->extension();
            if($request->image->move(public_path('storage/images/products'),$imageName)){
                $product->image = $imageName;
            }
        }
        $product->name = Str::title($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->vendor = $request->vendor;
        $product->slug = Str::slug($request->name);

        $product->discount = $request->has('discount') ? ($request->discount == "null" ? null : $request->discount) : null;

        $product->status = $request->has('status') ? $request->status : 0;

        $product->category_id = $category->id;
        $product->subcategory_id = $subcategory->id;
        $product->user_id = Auth::id();
        $product->save();

        return response()->json(['success' => 'Le produit a été ajouté avec succès!'], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'subcategory' => 'required',
            'price' => 'required|numeric',
            // 'discount' => 'integer|nullable',
            'vendor' => 'string|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/|nullable',
            'stock' => 'integer|nullable',
            'status' => 'boolean|nullable',
        ],[
            'name.required' => 'Le nom est obligatoire!',
            'name.string' => 'Le nom doit être un chaîne de caractères!',
            'name.min' => 'Le nom doit contenir au minimum 3 caractères!',
            'description.required'  => 'Le description est obligatoire!',
            'subcategory.required'  => 'La catégorie est obligatoire!',
            'price.required'  => 'Le prix est obligatoire!',
            // 'discount.integer'  => 'Le promotions doit être un nombre!',
            'vendor.regex'  => 'Le nom de fournisseur est invalide!',
        ]);

        $subcategory = Subcategory::findOrFail($request->subcategory['id']);
        $category = $subcategory->category()->first();

        $product = Product::findOrFail($id);

        $product->name = Str::title($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->vendor = $request->vendor;
        $product->slug = Str::slug($request->name);

        $product->discount = $request->has('discount') ? ($request->discount == "null" ? null : $request->discount) : null;

        $product->status = $request->has('status') ? $request->status : 0;

        $product->category_id = $category->id;
        $product->subcategory_id = $subcategory->id;
        $product->user_id = Auth::id();
        $product->save();

        return response()->json(['success' => 'Le produit a été modifié avec succès!'], 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->image !== 'default_product.png'){
            File::delete(public_path('storage/images/products/'.$product->image));
        }

        $product->delete();

        return response()->json(['success' => 'Le produit a été supprimé avec succès!'], 200);
    }


    public function changeImage(Request $request, $id){
        $request->validate([
            'image' => 'file|image|mimes:jpeg,jpg,png|nullable|max:1024',
        ],[
            'image.image'  => 'Le fichier doit être un image!',
            'image.required'  => 'L\'image est obligatoire!',
            'image.mimes'  => 'Le fichier doit être un image jpg, jpeg ou png!',
        ]);


        $product = Product::findOrFail($id);

        if($request->hasFile('image')){
            if($product->image !== 'default_product.png'){
                File::delete(public_path('storage/images/products/'.$product->image));
                $imageName =  Str::random(10).'.'.$request->image->extension();
                if($request->image->move(public_path('storage/images/products'),$imageName)){
                    $product->image = $imageName;
                }

            }else{
                $imageName = Str::random(20).'.'.$request->image->extension();
                if($request->image->move(public_path('storage/images/products'),$imageName)){
                    $product->image = $imageName;
                }
            }
        }

        $product->save();
        return response()->json(['image' => $product->image,'success' => 'L\'image a été modifé avec succés!'],200);
    }
}
