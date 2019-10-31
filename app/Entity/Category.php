<?php

namespace App\Entity;

use App\Entity\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    public $timestamps = false;
    protected $table = 'product_categories';
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function product()
    {
       return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
}
