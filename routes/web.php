<?php

Route::get('/', function (){
    return view('home');
});

Auth::routes();
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home', 'AdminController@index')->name('admin.home');

Route::get('/products', 'Product\ProductController@index')->name('products');
Route::get('/products/{product}', 'Product\ProductController@show')->name('product.show');
Route::post('/products/{product}', 'Product\ProductController@order');
Route::post('/products/rating/{product}', 'Product\ProductController@changeRate')->name('product.rating')->middleware('auth');
Route::post('/products/{product}/favorites', 'Product\FavoriteController@add')->name('product.favorites');
Route::delete('/products/{product}/favorites', 'Product\FavoriteController@remove');

Route::put('/products/addToCart', 'Product\CartController@addToCart')->name('product.addToCart');
Route::delete('/products/{product}/removeFromCart', 'Product\CartController@removeFromCart')->name('product.removeFromCart');
Route::patch('/products/{product}/updateCart', 'Product\CartController@updateCart')->name('product.updateCart');


Route::group([
    'prefix' => 'products/comments',
    'as' => 'products.comments.',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'Product\CommentController@show')->name('comments');
    Route::post('/{product}', 'Product\CommentController@store')->name('addComment');
    Route::put('/{comment}', 'Product\CommentController@update')->name('editComment');
    Route::delete('/{comment}', 'Product\CommentController@delete')->name('deleteComment');
});

Route::get('/cart', 'Cart\CartController@index')->name('cart.index');
Route::get('/allCartProd', 'Cart\CartController@showAll')->name('cart.all');

Route::group([
    'prefix' => 'cabinet',
    'as' => 'cabinet.',
    'namespace' => 'Cabinet',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', 'ProfileController@index')->name('home');
        Route::get('/edit', 'ProfileController@edit')->name('edit');
        Route::put('/update', 'ProfileController@update')->name('update');
        Route::post('/phone', 'PhoneController@request');
        Route::get('/phone', 'PhoneController@form')->name('phone');
        Route::put('/phone', 'PhoneController@verify')->name('phone.verify');
        Route::post('/phone/auth', 'PhoneController@auth')->name('phone.auth');
    });
});

