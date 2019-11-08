<?php


namespace App\UseCases\Products;


use App\Entity\Product\Category;
use App\Entity\Product\Product;
use App\Http\Requests\Admin\ImagesRequest;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function create(ProductRequest $request): Product
    {
        $categories = [];
        /** @var Category $category */
        foreach ($request['category'] as $cat_id) {
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
            if (array_filter($categories) !== null) {
                foreach ($categories as $category) {
                    $product->category()->attach($category);
                }
            }

            return $product;
        });
    }

    public function getPtoduct($id): Product
    {
        return Product::findOrFail($id);
    }

    public function addImages($id, ImagesRequest $request)
    {
        $product = $this->getPtoduct($id);

        DB::transaction(function () use ($request, $product) {
            foreach ($request['files'] as $file) {

                $product->images()->create(['file' => $file->store('adverts/'.$product->id, 'public')]);
            }
            $product->update();
        });
    }

    public function edit(Product $product, ProductRequest $request): Product
    {

        $product->update($request->only([
            'title',
            'slug',
            'description',
            'price'
        ]));

        if ($request['category'] !== null) {
            $product->category()->detach();
            foreach ($request['category'] as $category) {
                $product->category()->attach($category);
            }
        }

        return $product;

    }

    public function setStatus(Product $product): Product
    {
        $curStatus = $product->status;
        switch ($curStatus) {
            case 'active':
                $product->inactive();
                break;
            case 'inactive':
                $product->active();
                break;
        }
        return $product;
    }

    public function delete(Product $product)
    {
        try {
            $product->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.products.products.index')->with('error', $e->getMessage());
        }
    }
}
