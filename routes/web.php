<?php
Route::get('/', 'FrontEndController@index')->name('home');
//Customer
Route::get('customer/login', 'AuthCustomer\LoginController@showLoginForm')->name('customer.login');
Route::post('customer/login', 'AuthCustomer\LoginController@login')->name('customer.login');
Route::get('customer/logout', 'AuthCustomer\LoginController@logout')->name('customer.logout');
Route::get('customer/register', 'AuthCustomer\RegisterController@showRegistrationForm')->name('customer.register');
Route::post('customer/register', 'AuthCustomer\RegisterController@register')->name('customer.register');
//end Customer

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
    Route::resource('/hotels', 'HotelsController');
    Route::resource('/reservations', 'ReservationsController');
    Route::resource('/customers', 'customersController',['only'=>['index','show']]);
});
// end Admin
// Frontend
Route::get('/change-lang/{lang}', 'FrontEndController@changeLang')->name('home.change.lang');
Route::group(['prefix' => '/{lang}', 'middleware' => 'lang'], function () {
    Route::get('/', 'FrontEndController@homeWelcome')->name('home.welcome');
    Route::get('/s/{name}/{id}', 'SectionsController@show')->name('home.section');
    Route::get('/c/{name}/{id}', 'CategoriesController@show')->name('home.category');
    Route::get('/p/{name}/{id}', 'ProductsController@show')->name('home.product');
    Route::post('/cart/store', ['uses' => 'CartController@store'])->name('cart.store');
    Route::get('/cart/destroy/{cart_id}', ['uses' => 'CartController@destroy'])->name('cart.destroy');
    Route::get('/cart/all', ['uses' => 'CartController@index'])->name('cart.index');
    Route::get('/cart/checkout', ['uses' => 'CartController@checkout'])
        ->name('cart.checkout')
        ->middleware('auth:customer');
    Route::post('/cart/checkout/shipping-address/add', 'CustomerDetailsController@store')
        ->name('cart.checkout.shippingAddress.add')
        ->middleware('auth:customer');
    Route::put('/cart/checkout/shipping-address/update/{address_id}', 'CustomerDetailsController@update')
        ->name('cart.checkout.shippingAddress.update')
        ->middleware('auth:customer');
    Route::get('/cart/checkout/payment', ['uses' => 'CartController@payment'])
        ->name('cart.payment')
        ->middleware(['auth:customer', 'cart']);
    Route::post('/cart/checkout/payment/proceed', ['uses' => 'CartController@proceedPayment'])
        ->name('cart.payment.proceed')
        ->middleware('auth:customer');
    Route::get('/cart/checkout/payment/done/{reservation_id}', ['uses' => 'CartController@donePayment'])
        ->name('cart.payment.done');
    Route::get('/cart/checkout/payment/success/{reservation_id}', ['uses' => 'CartController@success'])
        ->name('cart.checkout.success')
        ->middleware('auth:customer');
});