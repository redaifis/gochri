<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index(){
        return view('app.cartPage');
    }

    public function getItems(){
        $items = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        return response()->json(['items' => $items,'total' => $total,'subtotal' => $subtotal],200);
    }


    public function addToCart(Request $request)
    {
        $item = Cart::add(['id' => $request->id, 'name' => $request->name, 'qty' => $request->quantity ? $request->quantity : 1,'price' => $request->price, 'weight' => 1, 'options' => ['image' => $request->image, 'slug' => $request->slug]])->associate('Product');
        return response()->json(['item' => $item, 'success' => 'Le produit a été ajouté dans le panier'],200);
    }

    public function updateItem(Request $request,$rowId)
    {
        $total = $request->price * $request->quantity;
        // update the item on cart
        $item = Cart::update($rowId, $request->quantity); // Will update the quantity

        return response()->json(['item' => $item, 'success' => 'Le produit a été modifié dans le panier'],200);
    }

    public function deleteItem($rowId)
    {
        // delete an item on cart
        $item = Cart::remove($rowId);
        return response()->json(['item' => $item, 'success' => 'Le produit a été supprimé dans le panier'],200);
    }

    public function destroyCart()
    {
        // delete all the items on cart
        Cart::destroy();
        return response()->json(['success'=>'Le panier est vide.'],200);
    }
}
