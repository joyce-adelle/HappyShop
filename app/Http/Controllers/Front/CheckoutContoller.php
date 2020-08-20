<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItems;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CheckoutContoller extends Controller
{
    public function index()
    {
        return view('front.checkout.index');
    }

    public function store(Request $request)
    {

        //Validate form
        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'address' => 'required',
            'city' => 'required',
            'provance' => 'required',
            'postal' => 'required',
            'phone' => 'required|numeric',
        ]);


        //save in database
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'date' => Carbon::now(),
            'address' => $request->address,
            'status' => 0,
        ]);

        foreach (Cart::content() as $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }

        Cart::destroy();

        //session msg
        $request->session()->flash('msg', 'Your order is completed');

        //redirect
        return redirect('/');
    }
}
