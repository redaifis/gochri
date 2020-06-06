<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {

    /* ----- Admin ----- */
    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

        // Dashboard
        Route::get('dashboard','Api\Admin\AdminController@dashboard');

        // Categories
        Route::apiResource('categories', 'Api\Admin\CategoryController');

        // Subcategories
        Route::apiResource('subcategories', 'Api\Admin\SubcategoryController');

        // Users
        Route::apiResource('users', 'Api\Admin\UserController');
        // Update Current Athenticated Admin User
        Route::get('profile/me', 'Api\Admin\UserController@myProfile');
        Route::put('profile/update', 'Api\Admin\UserController@updateProfile');
        Route::put('profile/image/update', 'Api\Admin\UserController@updateProfileImg');
        Route::put('profile/password/update', 'Api\Admin\UserController@changePassword');

        // Products
        Route::apiResource('products', 'Api\Admin\ProductController');
        // Update Product Image
        Route::put('products/{id}/image', 'Api\Admin\ProductController@changeImage');

        // Orders
        Route::apiResource('orders', 'Api\Admin\OrderController');
        // Update Order Status
        Route::put('orders/{id}/shipped', 'Api\Admin\OrderController@markShipped');
        Route::put('orders/{id}/paid', 'Api\Admin\OrderController@markPaid');

        /* ----- Settings ----- */
        // Shipping
        Route::get('settings/shipping','Api\Admin\ShippingController@index');
        Route::post('settings/shipping','Api\Admin\ShippingController@store');
        Route::delete('settings/shipping/{id}','Api\Admin\ShippingController@destroy');

    });

    /* ----- Customer ----- */
    Route::group(['prefix' => 'customer'], function () {

        // Orders
        Route::get('/orders','Api\Customer\CustomerController@orders');
        Route::get('/orders/{id}','Api\Customer\CustomerController@orderProducts');
        Route::post('/orders','Api\Customer\CustomerController@storeOrder');

        // Wishlist
        Route::get('/wishlist','Api\Customer\CustomerController@wishlistProducts');
        Route::put('/wishlist/{productId}','Api\Customer\CustomerController@toggleWishlist');

        // Profile
        Route::get('/profile','Api\Customer\CustomerController@me');
        Route::put('/profile','Api\Customer\CustomerController@modifyProfile');

        // Increase products sales when ordering
        Route::put('products/sales','Api\ProductController@productSales');

    });
});


// Main page
Route::get('mainpage','Api\MainController@getRessources');

// Search page
Route::post('search','Api\SearchController@search');

// products
Route::apiResource('products','Api\ProductController')->except(['store','update','destroy']);
Route::get('products/suggestions/{subcategory}','Api\ProductController@suggestions');

// subcategories
Route::apiResource('subcategories','Api\SubcategorytController')->except(['store','update','destroy']);

// categories
Route::apiResource('categories','Api\CategoryController')->except(['store','update','destroy']);

// Cart
Route::get('cart','Api\CartController@getItems');
Route::post('cart','Api\CartController@addToCart');
Route::put('cart','Api\CartController@updateItem');
Route::delete('cart/{id}','Api\CartController@removeItem');

// Shipping
Route::get('shipping-methods','Api\MainController@getShippingMethods');
