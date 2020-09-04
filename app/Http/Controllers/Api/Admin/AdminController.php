<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

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

        // Charts data
        $today = Carbon::today()->addDay();
        $weekBefore = Carbon::today()->subWeek()->addDay();
        $revenueData = Order::orderByDesc('created_at')->whereBetween('created_at', [$weekBefore, $today])->get()->groupBy(function($item) {
            return $item->created_at->format('d M');
        });

        $chartData = [
            $today->copy()->subDay()->format('d M') => [],
            $today->copy()->subDays(2)->format('d M') => [],
            $today->copy()->subDays(3)->format('d M') => [],
            $today->copy()->subDays(4)->format('d M') => [],
            $today->copy()->subDays(5)->format('d M') => [],
            $today->copy()->subDays(6)->format('d M') => [],
            $today->copy()->subDays(7)->format('d M') => [],
        ];

        foreach($revenueData as $key => $data){
            array_push($chartData[$key], $data);
        }


        return response()->json(compact(['orders' , 'products' , 'users_count', 'orders_count' , 'products_count' ,'revenue', 'chartData']),200);
    }


}
