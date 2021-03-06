<?php

namespace App\Http\Controllers\Admin\Products;

use App\Entity\Product\Category;
use App\Entity\Product\Product;
use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImagesRequest;
use App\Http\Requests\Admin\ProductRequest;
use App\UseCases\Products\ProductService;
use Hamcrest\Thingy;
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

    public function create(ProductRequest $request)
    {
        try {
            $product = $this->service->create($request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('product.show', $product)->with('success', 'Product created');
    }

    public function setStatus(Request $request)
    {
        $productId = Product::findOrFail($request->params['id']);
        return $this->service->setStatus($productId);
    }


    public function editForm(Product $product)
    {
        $productCategories = $product->category()->get();
        $selected = [];

        foreach ($productCategories as $productCategory) {
            $selected[] = $productCategory->id;
        }
        $categories = Category::defaultOrder()->withDepth()->get();
        return view('admin.products.products.edit', compact('product', 'productCategories', 'categories', 'selected'));
    }

    public function edit(ProductRequest $request, Product $product)
    {
        try {
            $this->service->edit($product, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $name = $product->title;
        try {
            $this->service->delete($product);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Product ' . $name . ' deleted');
    }

    public function images(ImagesRequest $request, Product $product)
    {
        try {
            $this->service->addImages($product->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.products.products.edit', $product);
    }
}
