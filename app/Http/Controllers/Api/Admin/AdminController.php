<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\User;


class AdminController extends Controller
{

     // Dashboard

    public function dashboard()
    {
        $orders = Order::orderBy('created_at','desc')->with('products')->take(5)->get();
        $products = Product::orderBy('created_at','desc')->take(5)->get();
        $users_count = User::all()->count();
        $orders_count = Order::all()->count();
        $products_count = Product::all()->count();

        // Calcul revenue
        $ordersRevenue = Order::where('payment_status',1)->get();
        $revenue = 0;
        foreach($ordersRevenue as $order){
            $revenue += $order->amount;
        }

        return response()->json(['orders' => $orders, 'products' => $products, 'users_count' => $users_count, 'orders_count' => $orders_count, 'products_count' => $products_count,'revenue' =>$revenue],200);
    }


}
