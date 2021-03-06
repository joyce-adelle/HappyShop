<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart as Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {

        return view('front.cart.index');
    }

    public function store(Request $request)
    {
        $dup = Cart::search(function ($cartItem, $rowId) use ($request){
            return $cartItem->id === (int) $request->id;
        });

        if($dup->isNotEmpty()){
            return redirect()->back()->with('msg', 'Product already in cart');
        }

        // Cart::store(auth()->user()->id);
        $product = Product::find($request->id);
        Cart::add($product, 1);

        return redirect()->back()->with('msg', $product->name . ' has been added to cart');
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('msg', 'Product  has been removed from cart');
    }

    public function addToWishlist($rowId)
    {

        $product = Cart::get($rowId)->model;
        Cart::remove($rowId);
        Cart::instance('wishlist')->add($product, 1);

        return redirect()->back()->with('msg', $product->name . ' has been added to wishlist');
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between: 1,5'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors','Quantity must be between 1 and 5');
        }

        Cart::update($id, $request->quantity);

        return redirect()->back()->with('msg','Quantity has been updated');
    }

}
