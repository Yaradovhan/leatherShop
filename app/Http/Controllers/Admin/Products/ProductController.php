<?php

namespace App\Http\Controllers\Admin\Products;

use App\Entity\Product\Product;
use App\Entity\User;
use App\Http\Controllers\Controller;
use App\UseCases\Products\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
        $this->middleware('can:manage-products');
    }

    public function index(Request $request)
    {
        $query = Product::orderByDesc('updated_at');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('title'))) {
            $query->where('title', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('category'))) {
            $query->where('category_id', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        $products = $query->paginate(20);

        $statuses = Product::statusesList();

        $roles = User::rolesList();

        return view('admin.products.products.index', compact('products', 'statuses', 'roles'));
    }
}
