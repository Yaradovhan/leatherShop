<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
        $cartData = $cart->content();
        return view('cart.index', compact('cartData'));
    }

    public function showAll(Cart $cart)
    {
        $cartData = $cart->content();
        return response()->json($cartData);
    }

    public function removeAll(Cart $cart)
    {
        $ret = 1;
        try{
            $cart->destroy();
        } catch (\Exception $e){
            $ret = 0;
        }

        return $ret;
    }
}
