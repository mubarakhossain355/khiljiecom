<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\CartController;

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
// Route::get('/dashboard', function () {
//     return view('backend.pages.dashboard');
// });

Route::prefix('')->group(function(){
    Route::get('/',[HomeController::class,'home'])->name('home');
    Route::get('/shop',[HomeController::class,'shopPage'])->name('shop-page');
    Route::get('/single-product/{product_slug}',[HomeController::class,'productDetails'])->name('productdetails.page');
    Route::get('/shopping-cart',[CartController::class,'cartPage'])->name('cart.page');
    Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('add-to.cart');
    Route::get('/remove-from-cart/{cart_id}',[CartController::class,'removeFromCart'])->name('removeFrom.cart');


});





Route::prefix('admin/')->group(function(){
    Route::get('login',[LoginController::class,'loginPage'])->name('admin.loginPage');
    Route::post('login',[LoginController::class,'login'])->name('admin.login');






    Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');


    Route::middleware(['auth'])->group(function(){
         Route::get('dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
         Route::resource('category', CategoryController::class);
         Route::resource('testimonial',TestimonialController::class);
         Route::resource('product',ProductController::class);
         Route::resource('coupon',CouponController::class);
    });


});
