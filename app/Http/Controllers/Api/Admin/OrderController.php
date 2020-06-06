<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('created_at','desc')->with(['products','user'])->get();
        return response()->json(['orders' => $orders],200);
    }

    public function markShipped($id){
        $order = Order::findOrFail($id);
        $order->shipping_status = 1;
        $order->save();
        return response()->json(['status' => $order->status, 'success' => 'La commande a été marqué comme livraisé!'], 200);
    }

    public function markPaid($id){
        $order = Order::findOrFail($id);
        $order->payment_status = 1;
        $order->save();
        return response()->json(['status' => $order->status, 'success' => 'La commande a été marqué comme payé!'], 200);
    }
}
