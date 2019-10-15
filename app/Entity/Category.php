<?php

namespace App\Entity;

use App\Entity\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function product()
    {
       return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
}
