<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\ThankyouComponnent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserEditProfileComponent;


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



Route::get('/',HomeComponent::class);
Route::get('shop',ShopComponent::class);
Route::get('cart',CartComponent::class)->name('product.cart');
Route::get('checkout',CheckoutComponent::class)->name('checkout');
Route::get('wishlist',WishlistComponent::class);
Route::get('product/{slug}/',DetailsComponent::class)->name('product.details');
Route::get('product-category/{category_slug}',CategoryComponent::class)->name('product.category');
Route::get('thank-you',ThankyouComponnent::class)->name('thank');

Route::get('/user/orders',UserOrdersComponent::class)->name('user.orders');
Route::get('/user/orders/{order_id}',UserOrderDetailsComponent::class)->name('user.orderdetails');
Route::get('/user/edit',UserEditProfileComponent::class)->name('user.profile_edit');


Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');  

});

Route::middleware(['auth:sanctum','verified'])->group(function(){
 Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard'); 
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
