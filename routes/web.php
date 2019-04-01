<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return "welcome";
});

// Admin
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\LoginController@login')->name('admin.login');
Route::get('/logout', 'Auth\LoginController@logout')->name('admin.logout');
Route::group(['prefix' => 'admin', 'middleware' => 'auth:web', 'as' => 'admin.'], function () {
    Route::get('/', 'AdminController@welcome')->name('admin.welcome');
    Route::resource('/filters', 'FiltersController');
    Route::resource('/brands', 'BrandsController');
    Route::resource('/sections', 'SectionsController');
    Route::get('/categories/brand/category/{id?}/', 'CategoriesController@getBrands')->name('categories.brands');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/vendors', 'VendorsController');
    Route::get('/products/brand/category/{id?}/', 'ProductsController@getBrands')->name('products.brands');
    Route::get('/products/filters/category/{id?}/', 'ProductsController@getFilters')->name('products.filters');
    Route::get('/products/filters/filter/{id?}/', 'ProductsController@getFilterItems')->name('products.filters.items');
    Route::resource('products', 'ProductsController');
    Route::resource('products/{product_id}/gallery', 'ProductGalleriesController');
});