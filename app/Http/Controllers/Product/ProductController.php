<?php

namespace App\Http\Controllers\Product;

use App\Entity\Product\Product;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Cart $cart, Product $product)
    {
        $products = Product::with('category')->where('status', '=', 'active')->paginate(12);
        $user = Auth::user();
        foreach ($products as $product){
            $product->isInCart($product, $cart);
        }
        return view('products.main', compact('products', 'user'));
    }

    public function show(Cart $cart, Product $product)
    {
        if (!($product->isActive())) {
            abort(404);
        }

        $user = Auth::user();
        $product->isInCart($product, $cart);

        return view('products.show', compact('product', 'user'));
    }

    public function changeRate(Request $request)
    {
        $id = $request['params']['postId'];
        $rating = $request['params']['rating'];
        $product = Product::findOrFail($id);
        $product->changeRate($rating);

        return ['averageRating' => $product->averageRating];
    }
}
