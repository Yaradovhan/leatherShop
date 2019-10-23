<?php

namespace App\Http\Controllers\Product;

use App\Entity\Product\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{



    public function addToCart(Cart $cart, CartRequest $request)
    {
        $id = $request->params['id'];
        $product = Product::findOrFail($id);
        $res = $cart->add($product->id, $product->title, 1, $product->price);
//        dd($res);
//        dump($cart->content());
    }

    public function removeFromCart(Product $product)
    {

    }

    public function getAll()
    {

    }

    public function updateCart(Product $product, Request $request)
    {

    }


}
