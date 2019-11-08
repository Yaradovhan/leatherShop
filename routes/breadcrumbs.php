<?php

use App\Entity\Page;
use App\Entity\Product\Product;
use App\Entity\User;
use App\Http\Router\PagePath;
use App\Entity\Product\Category;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;


Breadcrumbs::for('home', function (Crumbs $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::register('login', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Login', route('login'));
});

Breadcrumbs::register('login.phone', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Login', route('login.phone'));
});

Breadcrumbs::register('register', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Register', route('register'));
});

Breadcrumbs::register('password.request', function (Crumbs $crumbs) {
    $crumbs->parent('login');
    $crumbs->push('Reset Password', route('password.request'));
});

Breadcrumbs::register('password.reset', function (Crumbs $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push('Change', route('password.reset'));
});

Breadcrumbs::register('page', function (Crumbs $crumbs, PagePath $path) {
    if ($parent = $path->page->parent) {
        $crumbs->parent('page', $path->withPage($path->page->parent));
    } else {
        $crumbs->parent('home');
    }
    $crumbs->push($path->page->title, route('page', $path));
});

Breadcrumbs::for('products', function (Crumbs $trail) {
    $trail->parent('home');
    $trail->push('Products', route('products'));
});

Breadcrumbs::for('product.show', function (Crumbs $trail, Product $product) {
    $trail->parent('products');
    $trail->push($product->title, route('product.show', $product));
});

//Admin

Breadcrumbs::register('admin.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Admin', route('admin.home'));
});

Breadcrumbs::register('admin.products.products.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Products', route('admin.products.products.index'));
});

Breadcrumbs::register('admin.products.products.create.form', function (Crumbs $crumbs) {
    $crumbs->parent('admin.products.products.index');
    $crumbs->push('Create Product', route('admin.products.products.create.form'));
});

Breadcrumbs::register('admin.products.products.editForm', function (Crumbs $crumbs, Product $product) {
    $crumbs->parent('admin.products.products.index');
    $crumbs->push($product->title, route('admin.products.products.editForm', $product));
});

Breadcrumbs::register('admin.products.categories.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Categories', route('admin.products.categories.index'));
});

Breadcrumbs::register('admin.products.categories.show', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.products.categories.index');
    $crumbs->push($category->name, route('admin.products.categories.show',$category));
});

Breadcrumbs::register('admin.pages.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Pages', route('admin.pages.index'));
});

Breadcrumbs::register('admin.pages.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.pages.index');
    $crumbs->push('Create', route('admin.pages.create'));
});

Breadcrumbs::register('admin.pages.show', function (Crumbs $crumbs, Page $page) {
    if ($parent = $page->parent) {
        $crumbs->parent('admin.pages.show', $parent);
    } else {
        $crumbs->parent('admin.pages.index');
    }
    $crumbs->push($page->title, route('admin.pages.show', $page));
});

Breadcrumbs::register('admin.pages.edit', function (Crumbs $crumbs, Page $page) {
    $crumbs->parent('admin.pages.show', $page);
    $crumbs->push('Edit', route('admin.pages.edit', $page));
});

Breadcrumbs::register('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push('Users', route('admin.users.index'));
});

Breadcrumbs::register('admin.users.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->getFullName(), route('admin.users.show', $user));
});

Breadcrumbs::register('admin.users.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push($user->getFullName(), route('admin.users.edit', $user));
});

//Cart

Breadcrumbs::register('cart.index', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Cart', route('cart.index'));
});

//Cabinet


Breadcrumbs::register('cabinet.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push('Cabinet', route('cabinet.home'));
});
