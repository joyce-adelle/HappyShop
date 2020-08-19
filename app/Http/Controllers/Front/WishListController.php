<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function store(Request $request)
    {

        $product = Product::find($request->id);
        Cart::instance('wishlist')->add($product, 1);

        return redirect()->back()->with('msg', $product->name . ' has been added to wishlist');
    }

    public function remove($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->back()->with('msg', 'Product  has been removed from wishlist');
    }

    public function moveToCart($rowId)
    {

        $product = Cart::instance('wishlist')->get($rowId)->model;
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('default')->add($product, 1);

        return redirect()->back()->with('msg', $product->name . ' has been added to cart');
    }
}
