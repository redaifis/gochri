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


Route::group(['middleware' => ['auth:api','admin'], 'prefix' => 'admin'], function () {

    // Dashboard
    Route::get('dashboard','Api\admin\AdminController@dashboard');

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
    Route::put('orders/{id}/refunded', 'Api\Admin\OrderController@markRefunded');

    /* ----- Settings ----- */
    // Shipping
    Route::get('settings/shipping','Api\Admin\ShippingController@index');
    Route::post('settings/shipping','Api\Admin\ShippingController@store');
    Route::delete('settings/shipping/{id}','Api\Admin\ShippingController@destroy');

});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'customer'], function () {

});

