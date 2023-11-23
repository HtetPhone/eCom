<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('page.index');
    Route::get('/redirect', 'differ')->middleware(['auth', 'verified']);
    Route::get('/products/{id}', 'singleProduct')->name('page.sproduct');
    Route::get('/search', 'search')->name('search');
    Route::get('/categorize', 'categorize')->name('categorize');

    Route::middleware('auth')->group(function () {
        Route::post('/add_to_cart/product/{product:id}', 'addToCart')->name('to.cart');
        Route::post('/buy_now/product/{product:id}', 'buyNow')->name('buy.now');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::delete('/checkout/{cart:id}/remove', 'removeCart')->name('remove.cart');
        Route::get('/clear-cart', 'clearCart')->name('clear.cart');
        Route::get('/payment/cash-on', 'cashOn')->name('cash.on');
        Route::get('/user/order', 'userOrder')->name('user.order');
        Route::post('/user/{order:id}/order', 'cancelOrder')->name('cancel.order');
    });
});

//Stripe Payment GateWay
Route::controller(StripeController::class)->middleware('auth')->group(function () {
    Route::get('/stripe', 'stripe')->name('with.card');
    Route::post('/stripe/{total_amount}', 'stripePost')->name('stripe.post');
});

//admin
Route::controller(DashboardController::class)->middleware(['auth', 'ensure.admin'])->prefix('dashboard')->group(function () {
    Route::get('/',  'dashboard')->name('dashboard');
    Route::get('/users', 'userList')->name('users.list');
    Route::get('/orders', 'orderList')->name('orders.list');
    Route::put('/orders/{order:id}/deliever', 'deliever')->name('order.deliever');
    Route::get('/orders/{order:id}/print', 'printOrder')->name('print.order');
});


//products
Route::resource('/product', ProductController::class)->middleware(['auth', 'ensure.admin']);

//categories
Route::controller(CategoryController::class)->middleware(['auth', 'ensure.admin'])->prefix('category')->group(function () {
    Route::get('/index', 'category_list')->name('category.list');
    Route::post('/create', 'store')->name('category.store');
    Route::get('/edit/{category:id}', 'edit')->name('category.edit');
    Route::put('/edit/{category:id}', 'update');
    Route::delete('/{category:id}', 'destroy')->name('category.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Auth::routes(['verify' => true]);
require __DIR__ . '/auth.php';
