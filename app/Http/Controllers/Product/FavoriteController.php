<?php

namespace App\Http\Controllers\Product;

use App\Entity\Product\Product;
use App\Http\Controllers\Controller;
use App\UseCases\Products\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    private $service;

    public function __construct(FavoriteService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function add(Product $product)
    {
        try {
            $this->service->add(Auth::id(), $product->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function remove(Product $product)
    {
        try {
            $this->service->remove(Auth::id(), $product->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
