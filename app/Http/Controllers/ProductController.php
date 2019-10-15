<?php

namespace App\Http\Controllers;

use App\Entity\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->where('status','=','active')->paginate(10);

        return view('products.main', compact('products'));
    }

    public function show(Product $product)
    {
        if (!($product->isActive())) {
            abort(404);
        }

        $user = Auth::user();

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
