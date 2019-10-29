<?php


namespace App\UseCases\Products;


use App\Entity\Product\Product;
use App\Http\Requests\Admin\CreateProductRequest;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function create(CreateProductRequest $request) :Product
    {
//        $category = Category::findOrFail($categoryId);

        return DB::transaction(function () use ($request) {

            /* @var Product $product */
            $product = Product::make([
                'title' => $request['title'],
                'description' => $request['description'],
                'price' => $request['price'],
                'status' => Product::STATUS_ACTIVE,
            ]);

//            $advert->user()->associate($user);
//            $advert->region()->associate($region);
//            $advert->category()->associate($category);

            $product->saveOrFail();

//            foreach ($category->allAttributes() as $attribute) {
//                $value = $request['attributes'][$attribute->id] ?? null;
//                if (!empty($value)) {
//                    $advert->values()->create([
//                        'attribute_id' => $attribute->id,
//                        'value' => $value,
//                    ]);
//                }
//            }
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
}
