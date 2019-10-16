<?php


namespace App\UseCases\Products;


use App\Entity\Product\Product;
use App\Entity\User;

class FavoriteService
{
    public function add($userId, $productId): void
    {
        $user = $this->getUser($userId);
        $product = $this->getProduct($productId);

        $user->addToFavorites($product->id);
    }

    private function getUser($userId): User
    {
        return User::findOrFail($userId);
    }

    private function getProduct($productId): Product
    {
        return Product::findOrFail($productId);
    }

    public function remove($userId, $productId): void
    {
        $user = $this->getUser($userId);
        $product = $this->getProduct($productId);

        $user->removeFromFavorites($product->id);
    }
}
