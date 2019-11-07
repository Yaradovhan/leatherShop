<?php

namespace App\Entity\Product;

use App\Entity\Product\Comment;
use App\Entity\Product\Image as Photo;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Reatable\Reatable as Rateable;

/**
 * Class Product
 * @property integer id
 * @property string title
 * @property string slug
 * @property string description
 * @property double price
 * @property string status
 * @package App\Entity\Product
 * @package  App\Reatable\Reatable
 * @method static findOrFail($id)
 */
class Product extends Model
{
    use Rateable;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    protected $fillable = ['title', 'slug', 'description', 'price', 'status'];

    protected $guarded = ['id'];

    protected $table = 'products';

    public static function statusesList(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive'
        ];
    }

    public function inactive(): void
    {
        $this->update([
            'status' => self::STATUS_INACTIVE,
        ]);
    }

    public function active(): void
    {
        $this->update([
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isClosed(): bool
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }
//
//    public function photos()
//    {
//        return $this->hasMany(Photo::class, '_id', 'id');
//    }

    /**
     * @param $rating
     * @return $this
     */
    public function changeRate($rating)
    {
        $this->ratings()->updateOrCreate(
            ['user_id' => auth()->id(), 'rateable_id' => $this->id],
            ['user_id' => auth()->id(), 'rateable_id' => $this->id, 'rating' => $rating, 'rateable_type' => __CLASS__]
        );

        return $this;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function isInCart($product, Cart $cart)
    {
        $res = $cart->search(function ($cartItem) use ($product) {
            return $cartItem->id === $product->id;
        });

        $product['isInCart'] = count($res) > 0 ? true : false;

        return $product;

    }

}
