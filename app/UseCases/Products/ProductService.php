<?php


namespace App\UseCases\Products;


use App\Entity\Product\Category;
use App\Entity\Product\Product;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function create(ProductRequest $request) :Product
    {
        $categories = [];
        /** @var Category $category */
        foreach ($request['category'] as $cat_id){
            $categories[] = Category::find($cat_id);
        }

        return DB::transaction(function () use ($request, $categories) {

            /* @var Product $product */
            $product = Product::make([
                'title' => $request['title'],
                'slug' => $request['slug'],
                'description' => $request['description'],
                'price' => $request['price'],
                'status' => Product::STATUS_ACTIVE,
            ]);

            $product->saveOrFail();
            if(array_filter($categories) !== null){
                foreach ($categories as $category){
                    $product->category()->attach($category);
                }
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

    public function edit(Product $product, ProductRequest $request): Product
    {

        $product->update($request->only([
            'title',
            'slug',
            'description',
            'price',
            'status'
        ]));

        if($request['category'] !== null){
           $product->category()->detach();
            foreach ($request['category'] as $category){
                $product->category()->attach($category);
            }
        }

        return $product;

    }

    public function setActive(Product $product)
    {

    }
    public function setInctive(Product $product)
    {

    }
}
