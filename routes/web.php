<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
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

Route::controller(PageController::class)->group( function() {
    Route::get('/', 'index')->name('page.index');
    Route::get('redirect', 'redirect');
    Route::get('/products/{id}', 'singleProduct')->name('page.sproduct');
    Route::get('/search', 'search')->name('search');
    Route::get('/categorize', 'categorize')->name('categorize');
    Route::post('/add_to_cart/product/{product:id}', 'addToCart')->name('to.cart');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::delete('/checkout/{cart:id}/remove', 'removeCart')->name('remove.cart');
    Route::get('/clear-cart', 'clearCart')->name('clear.cart');
    Route::get('/payment/cash-on', 'cashOn')->name('cash.on');
});

//Stripe Payment GateWay
Route::controller(StripeController::class)->group(function() {
    Route::get('stripe', 'stripe')->name('with.card');
    Route::post('stripe/{total_amount}', 'stripePost')->name('stripe.post');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//admin
Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware('auth', 'verified')->name('dashboard');

//products
Route::resource('/product', ProductController::class)->middleware('auth');

//categories
Route::controller(CategoryController::class)->prefix('category')->group( function() {
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

Route::get('/test', function() {
   return view('checkout');
});
require __DIR__.'/auth.php';
