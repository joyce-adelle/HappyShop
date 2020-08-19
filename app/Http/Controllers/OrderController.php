<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItems;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::all();
        return view('admin.orders.index', compact('orders') );
    }

    public function confirm($id){

        //Find order
        $order = Order::Find($id);

        //update order
        $order->update(['status' => 1]);

        //send message
        session()->flash('msg', 'Order has been confirmed');

        //redirect
        return redirect('/admin/orders');
    }

    public function pending($id){

        //Find order
        $order = Order::Find($id);

        //update order
        $order->update(['status' => 0]);

        //send message
        session()->flash('msg', 'Order is pending');

        //redirect
        return redirect('/admin/orders');
    }

    public function show($id){

        $order = Order::find($id);

        return view('admin.orders.details', compact('order'));
    }

}
