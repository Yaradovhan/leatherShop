<?php

namespace App\Http\Controllers\Admin\Products;

use App\Entity\Product\Category;
use App\Entity\Product\Product;
use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductRequest;
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
            $query->join('category_product', 'products.id', '=', 'category_product.product_id')
                ->where('category_product.category_id', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        $products = $query->paginate(20);

        $statuses = Product::statusesList();

        $roles = User::rolesList();

        $categories = Category::defaultOrder()->withDepth()->get();

        return view('admin.products.products.index', compact('products', 'statuses', 'roles', 'categories'));
    }

    public function createForm()
    {
        $categories = Category::defaultOrder()->withDepth()->get();
        return view('admin.products.products.create', compact('categories'));
    }

    public function create(CreateProductRequest $request)
    {
        try {
            $product = $this->service->create(
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('product.show', $product)->with('success', 'Product created');
    }
}
