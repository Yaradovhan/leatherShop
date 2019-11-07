<?php

Auth::routes();
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/admin/home', 'AdminController@index')->name('admin.home');

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
Route::delete('/allCartProd/remove', 'Cart\CartController@removeAll')->name('cart.removeAll');
Route::delete('/cartProd/remove', 'Cart\CartController@removeOne')->name('cart.removeOne');


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

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'can:admin-panel']
], function () {
    Route::post('/ajax/upload/image', 'UploadController@image')->name('ajax.upload.image');
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/users/{user}/verify', 'UsersController@verify')->name('users.verify');
    Route::resource('users', 'UsersController');

    Route::group(['prefix' => 'products', 'as' => 'products.', 'namespace' => 'Products'], function () {

        Route::resource('categories', 'CategoryController');

        Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
            Route::post('/first', 'CategoryController@first')->name('first');
            Route::post('/up', 'CategoryController@up')->name('up');
            Route::post('/down', 'CategoryController@down')->name('down');
            Route::post('/last', 'CategoryController@last')->name('last');
            Route::resource('attributes', 'AttributeController')->except('index');
        });

        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::get('/', 'ProductController@index')->name('index');
            Route::get('/create', 'ProductController@createForm')->name('create.form');
            Route::post('/create', 'ProductController@create')->name('create');
            Route::get('/{product}/edit', 'ProductController@editForm')->name('editForm');
            Route::post('/{product}/edit', 'ProductController@edit')->name('edit');
            Route::put('/{product}/set/active', 'ProductController@setActive')->name('set.active');
            Route::put('/{product}/set/inactive', 'ProductController@setInactive')->name('set.inactive');
            Route::get('/{product}/photos', 'ProductController@photosForm')->name('photos');
            Route::post('/{product}/photos', 'ProductController@photos');
            Route::post('/{product}/moderate', 'ProductController@moderate')->name('moderate');
            Route::delete('/{advert}/destroy', 'ProductController@destroy')->name('destroy');
        });
    });

    Route::resource('pages', 'PageController');

    Route::group(['prefix' => 'pages/{page}', 'as' => 'pages.'], function () {
        Route::post('/first', 'PageController@first')->name('first');
        Route::post('/up', 'PageController@up')->name('up');
        Route::post('/down', 'PageController@down')->name('down');
        Route::post('/last', 'PageController@last')->name('last');
    });
});
Route::get('/{page_path}', 'PageController@show')->name('page')->where('page_path', '.+');
