<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'],function(){

    /* ----- ADMIN ----- */
    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

        // dashboard
        Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin');
        Route::get('/', function(){
            return redirect('/admin/dashboard');
        });

        // Orders
        Route::resource('/orders','Admin\OrderController')->except(['store','update','delete']);

        // Products
        Route::resource('/products', 'Admin\ProductController')->except(['store','update','delete']);

        // Categories
        Route::get('/categories', 'Admin\CategoryController@index');

        // Subcategories
        Route::resource('subcategories', 'Admin\SubcategoryController');

        // Users
        Route::resource('/users', 'Admin\UserController')->except(['store','update','delete']);

        // Edit Profile
        Route::get('/profile/{id}/edit','Admin\AdminController@editProfile');

        /* ----- Settings ----- */
        Route::get('/settings','Admin\AdminController@settings');

        // Shipping
        Route::get('/settings/shipping','Admin\AdminController@shipping');

        // Payment
        Route::get('/settings/payment','Admin\AdminController@payment');

    });

    /* ----- CUSTOMER ----- */
    Route::group(['middleware' => 'customer', 'prefix' => 'customer'],function(){
        Route::get('/dashboard', 'Customer\CustomerController@index')->name('customer');
    });

});


Route::get('/', 'TestController@checkout');


/* ----- Authentication using providers: Google - Facebook ----- */
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')
    ->name('login.callback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
