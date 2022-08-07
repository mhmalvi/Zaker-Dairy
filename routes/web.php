<?php

use Illuminate\Support\Facades\Route;

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

/**
 * for social media login routes
 */
Route::get('google/login', 'GoogleController@loginWithGoogle')->name('google.login');
Route::get('google/callback', 'GoogleController@callbackFromGoogle')->name('google.callback');

Route::get('facebook/login', 'FacebookController@loginWithFacebook')->name('facebook.login');
Route::get('facebook/login/extra', 'FacebookController@askExtraInfo')->name('facebook.login.extra');
Route::post('facebook/login/extra', 'FacebookController@saveExtraInfo')->name('facebook.login.extra.submit');
Route::get('facebook/callback', 'FacebookController@callbackFromFacebook')->name('facebook.callback');

/**
 * Home
 */
Route::get('/', 'HomeController@index')->name('index');
Route::get('about-us', 'HomeController@AboutUs')->name('about.us');
Route::get('contact-us', 'HomeController@ContactUs')->name('contact.us');

Route::get('/other_products', 'ProductsController@getOtherProducts')->name('other_products');

Route::get('item/{product}', 'HomeController@product');

/**
 * CartController
 */
Route::prefix('cart')->group(function () {
    Route::get('/', 'CartController@index')->name('cart');
    Route::post('{product}/add', 'CartController@store')->name('add.cart');
    Route::post('update', 'CartController@update')->name('qty.update');
    Route::get('{product}/remove', 'CartController@remove')->name('item.remove');
    Route::delete('destroy', 'CartController@destroy')->name('cart.destroy');
});

Route::middleware('checkout')->group(function () {
    Route::get('/show/checkout', 'CheckOutController@index')->name('checkout');
    Route::post('/checkout', 'CheckOutController@checkout');
    Route::post('/checkout/login', 'CheckOutController@login')->name('checkout.login');
});
Route::get('/checkout/success', 'CheckOutController@success')->name('checkout.success');
Route::get('shop', 'ShopController@index')->name('shop');
Route::get('shop/{slug}', 'ShopController@categoryProduct')->name('category');
Route::get('{category_slug}/{product_slug}', 'ShopController@item')->name('item');

/**
 * Terms and Conditions
 */
 
Route::get('terms_conditions', 'HomeController@terms_conditions')->name('terms.conditions');


require __DIR__ . '/auth.php';


/**
 * Customer should be registered before checkout
 *
 */
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', 'CustomerController@index')->name('dashboard');
      Route::post('/update/user', 'CustomerController@updateUser')->name('update.user');
    Route::post('/update/billing/address', 'CustomerController@updateBillingAddress')->name('update.billing.address');
     Route::get('view/order/{uuid}', 'CustomerController@viewOrder')->name('view.order');
});

/**
 * 
 * mail send
 * 
 */

Route::post('contact/mail', 'ContactController@contact')->name('contact.mail');