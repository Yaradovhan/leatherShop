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
}
