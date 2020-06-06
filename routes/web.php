<?php

use Illuminate\Support\Facades\Route;


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

        // Dashboard
        Route::get('/dashboard', 'Customer\CustomerController@index');

        // Compte
        Route::get('/compte', 'Customer\CustomerController@compte');

        // Wishlist
        Route::get('/wishlist', 'Customer\CustomerController@wishlist');

        // Orders
        Route::get('/orders', 'Customer\CustomerController@orders');

        // Show Order
        Route::get('/orders/{id}', 'Customer\CustomerController@orderPage');

    });

});

// Login & Register & Logout
Route::get('/login','AuthController@loginPage')->name('login');
Route::get('/register','AuthController@registerPage')->name('register');
Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');
Route::post('/logout','AuthController@logout')->name('logout');

// Landing page
Route::get('/', 'MainController@index');

// search Page
Route::get('/search/{type?}/{searchText?}', 'SearchController@searchPage');

// Show Product
Route::get('/products/{slug}', 'ProductController@show');

// Cart page
Route::get('/cart', 'CartController@index');
Route::get('/cart/all', 'CartController@getItems');
Route::post('/cart', 'CartController@addToCart');
Route::put('/cart/{rowId}', 'CartController@updateItem');
Route::delete('/cart/{rowId}', 'CartController@deleteItem');
Route::delete('/cart/items/destroy', 'CartController@destroyCart');


/* --- Other Pages --- */

// About page
Route::get('/about', 'MainController@about');

// Contact page
Route::get('/contact', 'MainController@contact');

// Privacy policy
Route::get('/privacy-policy', 'MainController@privacyPolicy');

// Charge payment - Stripe
Route::post('/charge', 'CheckoutController@charge');

// Thank you page
Route::get('/thank-you', 'CheckoutController@thankYou');


/* ----- Authentication using: Google - Facebook ----- */
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')
    ->name('login.callback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
