<?php

use App\Entity\Product\Product;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;


Breadcrumbs::for('home', function (Crumbs $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('products', function (Crumbs $trail) {
    $trail->parent('home');
    $trail->push('Products', route('products'));
});
Breadcrumbs::for('product.show', function (Crumbs $trail, Product $product) {
    $trail->parent('products');
    $trail->push($product->title, route('product.show', $product));
});
