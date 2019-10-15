<?php

Route::get('/', function (){
    return view('home');
});

Auth::routes();
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home', 'AdminController@index')->name('admin.home');

Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/{product}', 'ProductController@show')->name('product.show');
Route::post('/products/{product}', 'ProductController@order');
Route::post('/products/rating/{product}', 'ProductController@changeRate')->name('product.rating')->middleware('auth');


Route::group([
    'prefix' => 'products/comments',
    'as' => 'products.comments.',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'CommentController@show')->name('comments');
    Route::post('/{product}', 'CommentController@store')->name('addComment');
    Route::put('/{comment}', 'CommentController@update')->name('editComment');
    Route::delete('/{comment}', 'CommentController@delete')->name('deleteComment');
});


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

    Route::get('favorites', 'FavoriteController@index')->name('favorites.index');
    Route::delete('favorites/{advert}', 'FavoriteController@remove')->name('favorites.remove');
});
