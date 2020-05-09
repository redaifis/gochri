<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index');

Auth::routes();

Route::prefix('admin')->middleware(['auth','admin'])->group(function(){

    // dashboard
    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin');

    // Orders
    Route::resource('/orders','Admin\OrderController');
    Route::put('/orders/{id}/ship','Admin\OrderController@markShipped');
    Route::put('/orders/{id}/refund','Admin\OrderController@markRefunded');

    // Products
    Route::resource('/products', 'Admin\ProductController');

    // Categories
    Route::resource('/categories', 'Admin\CategorieController');

    // Subcategories
    Route::resource('/subcategories', 'Admin\SubcategorieController');

    // Users
    Route::resource('/users', 'Admin\UserController');

    // Edit Profile
    Route::get('/profile/{id}/edit','Admin\AdminController@editProfile');
    Route::put('/profile/{id}','Admin\AdminController@updateProfile');
    Route::put('/profile/password/{id}','Admin\AdminController@changePassword');

    /* ----- Settings ----- */
    Route::get('/settings','Admin\AdminController@settings');
    // Shipping
    Route::get('/settings/shipping','Admin\AdminController@shipping');
    Route::post('/settings/shipping','Admin\AdminController@addShipping');
    Route::delete('/settings/shipping/{id}','Admin\AdminController@deleteShipping');
    // Payment
    Route::get('/settings/payment','Admin\AdminController@payment');

});

Route::prefix('customer')->middleware(['auth','customer'])->group(function(){
    Route::get('/dashboard', 'Customer\CustomerController@index')->name('customer');
});
