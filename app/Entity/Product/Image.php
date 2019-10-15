<?php

namespace App\Entity\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package App\Entity\Product
 *
 * @property Product $product_id
 * @property string $path
 */
class Image extends Model
{
    public $timestamps = false;
    protected $table = 'images';
    protected $fillable = ['file'];
}
