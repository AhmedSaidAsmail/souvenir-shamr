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
    Route::resource('/categories', 'CategoriesController');
});