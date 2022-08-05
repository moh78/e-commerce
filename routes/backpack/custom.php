<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('category', 'CategoryCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('sale', 'SaleCrudController');
    Route::crud('coupon', 'CouponCrudController');
    Route::crud('order-item', 'OrderItemCrudController');
    Route::crud('shipping', 'ShippingCrudController');
    Route::crud('transaction', 'TransactionCrudController');
    Route::crud('order', 'OrderCrudController');
    Route::crud('setting', 'SettingCrudController');
}); // this should be the absolute last line of this file