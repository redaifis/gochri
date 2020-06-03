<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('app.customer.dashboard');
    }

    public function compte(){
        return view('app.customer.customerCompte');
    }

    public function orders(){
        return view('app.customer.ordersPage');
    }

    public function orderPage($id){
        $order = Order::where('id',$id)->with(['products','shipping'])->first();
        return view('app.customer.orderPage',compact('order'));
    }

    public function wishlist(){
        return view('app.customer.wishlistPage');
    }
}
