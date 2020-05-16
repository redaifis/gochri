<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index');

Auth::routes();

/* ----- ADMIN ----- */
Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    
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
    Route::get('/subcategories', 'Admin\SubcategoryController@index');
    Route::get('/subcategories/create', 'Admin\SubcategoryController@create');
    Route::post('/subcategories', 'Admin\SubcategoryController@store');

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
Route::prefix('customer')->middleware(['auth','customer'])->group(function(){
    Route::get('/dashboard', 'Customer\CustomerController@index')->name('customer');
});
