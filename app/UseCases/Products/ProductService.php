<?php


namespace App\UseCases\Products;


use App\Entity\Product\Category;
use App\Entity\Product\Product;
use App\Http\Requests\Admin\CreateProductRequest;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function create(CreateProductRequest $request) :Product
    {
        /** @var Category $category */
        $category = Category::find($request['category']);

        return DB::transaction(function () use ($request, $category) {

            /* @var Product $product */
            $product = Product::make([
                'title' => $request['title'],
                'slug' => $request['slug'],
                'description' => $request['description'],
                'price' => $request['price'],
                'status' => Product::STATUS_ACTIVE,
            ]);

            $product->saveOrFail();
            if($category !== null){
                $product->category()->attach($category);
            }

            return $product;
        });
    }

    public function getPtoduct($id)
    {
        return Product::findOrFail($id);
    }

    public function addPhoto()
    {

    }

    public function edit($id, EditRequest $request): void
    {
        $product = $this->getPtoduct($id);
        $product->update($request->only([
            'title',
            'slug',
            'description',
            'price',
            'status'
        ]));
    }
}
