<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

/* Users Routes */

Route::get('/test', function () {
    $category  = Category::all();
    return view('test', compact('category'));
});


Route::get('/lang/{lang}', function ($lang) {

    session()->put('lang', $lang);
    return redirect()->back()->with('success', 'Language Switched.');
});


Route::get('/', 'PageController@home');
Route::get('/product', 'ProductController@all');
Route::get('/product/{slug}', 'ProductController@detail');
Route::get('/profile', 'ProfileController@show');

// api routes
Route::group([
    'prefix' => 'api',
    'namespace' => "Api"
], function () {
    Route::post('add-to-cart', 'CartApi@addToCart');
    Route::get('cart', 'CartApi@cart');
    Route::post('cart/{id}', 'CartApi@removeCart');
    Route::post('cart/add-qty/{id}', 'CartApi@addQty');
    Route::post('checkout', 'CartApi@checkout');
    Route::get('order', 'CartApi@order');

    Route::post('save-product', 'ProductApi@saveProduct');

    Route::post('make-review', 'ProductApi@makeReview');
    Route::get('product-review/{id}', 'ProductApi@getReview');

    // profile api
    Route::post('/change-password', 'ProfileApi@changePassword');
});

Route::get('/login', 'AuthController@showLogin');
Route::post('/login', 'AuthController@login');
Route::get('/register', 'AuthController@showRegister');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'RedirectIfNotLogin'], function () {
    Route::get('/logout', 'AuthController@logout');
    Route::get('/profile', 'ProfileController@show');
});


/* Admin Routes */
Route::get('/admin/login', 'Admin\AuthController@showLogin');
Route::post('/admin/login', 'Admin\AuthController@login');
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'RedirectIfNotAdminAuth',
    'as' => 'admin.'
], function () {
    Route::get('/logout', 'AuthController@logout');
    Route::get('/', 'PageController@dashboard');

    Route::resource('supplier', 'SupplierController');
    Route::resource('product', 'ProductController');

    // order
    Route::get('/order', 'OrderController@index');
    Route::get('/order-status', 'OrderController@changeOrderStatus');
});
