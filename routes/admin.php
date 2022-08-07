<?php

use App\Http\Middleware\CheckForAdmin;
use App\Http\Middleware\CheckForNormalAdmin;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', 'HomeController@index')->name('dashboard');


Route::prefix('categories')->name('category.')->group(function () {
    Route::get('/', 'CategoryController@index')->name('index');
    Route::get('list', 'CategoryController@paginatedList')->name('list');
    Route::get('raw', 'CategoryController@rawList')->name('raw');
    Route::get('/add', 'CategoryController@create')->name('create');
    Route::post('store', 'CategoryController@store')->name('store');
    Route::get('{product_category:slug}/edit', 'CategoryController@edit')->name('edit');
    Route::patch('{product_category:slug}/update', 'CategoryController@update')->name('update');
    Route::delete('{product_category:slug}/delete', 'CategoryController@delete')->name('delete');
});


Route::prefix('products')->group(function () {
    Route::get('/', 'ProductController@index')->name('products');
    Route::get('/get', 'ProductController@get');
    Route::get('/view/{uuid}', 'ProductController@show')->name('product.view');
    Route::put('/attributes', 'ProductController@attribute');
    Route::get('/add', 'ProductController@create')->name('products.create');
    Route::post('/store', 'ProductController@store')->name('products.store');
    Route::get('/edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::post('/update', 'ProductController@update')->name('product.update');
    Route::get('/{product}/trash', 'ProductController@trash')->name('product.remove');
});
Route::prefix('backgrounds')->group(function () {
    Route::get('/', 'BackgroundController@index')->name('backgrounds');
    Route::get('/create', 'BackgroundController@create')->name('backgrounds.create');
    Route::post('/store', 'BackgroundController@store')->name('backgrounds.store');
    Route::get('/edit/{id}', 'BackgroundController@edit')->name('backgrounds.edit');
    Route::post('/update', 'BackgroundController@update')->name('backgrounds.update');
    Route::get('/delete/{id}', 'BackgroundController@destroy')->name('backgrounds.delete');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', 'UsersController@index')->name('index');
    Route::get('all', 'UsersController@paginatedList')->name('all');
    Route::get('{user:uuid}/edit', 'UsersController@edit')->name('edit');
    Route::post('/update', 'UsersController@update')->name('update');

    Route::patch('{user:uuid}/status/toggle', 'UsersController@toggleStatus')->name('status.update');
});

Route::get('orders', 'OrderController@index')->name('orders');
Route::get('orders/{order:uuid}', 'OrderController@show')->name('order.show');
Route::post('orders/status-update', 'OrderController@updateStatus')->name('order.status.update');
Route::post('orders/filter', 'OrderController@orderFilter')->name('orders.filter');

Route::prefix("promotional_banners")->group(function () {
    Route::get('index', 'PromotionalBannersController@index')->name('banner.index');
    Route::get('/', 'PromotionalBannersController@getBanners');
    Route::post('update', 'PromotionalBannersController@updateBanners');
    Route::delete('1', 'PromotionalBannersController@deleteBanner1');
    Route::delete('2', 'PromotionalBannersController@deleteBanner2');
});
Route::prefix("home_sliders")->name('home_sliders.')->group(function () {
    Route::get("/", 'HomeSlidersController@index')->name('index');
    Route::get('/all', 'HomeSlidersController@getAll');
    Route::get('/create', 'HomeSlidersController@create')->name('create');
    Route::post('/store', 'HomeSlidersController@store')->name('home_sliders.store');
    Route::get('{home_slider}/edit', 'HomeSlidersController@edit')->name('edit');
    Route::post('/update', 'HomeSlidersController@update');
    Route::get('/{home_slider}/delete', 'HomeSlidersController@destroy');
});


Route::prefix("website_identity")->name('website_identity.')->group(function () {
    Route::get('/', 'WebsiteIdentityController@index')->name('index');
    Route::patch('/', 'WebsiteIdentityController@update')->name('update');
});

Route::prefix('terms_conditions')->name('terms_conditions.')->group(function () {
    Route::get('/', 'TermsConditionsController@index')->name('index');
});

Route::prefix("contents")->name('contents.')->group(function () {
    Route::post('store', 'ContentsController@store')->name('save');
});

Route::prefix('about_us')->name('about_us.')->group(function () {
    Route::get('/', 'AboutUsController@index')->name('index');
});

// service route
Route::prefix('service')->name('service.')->group(function () {
    Route::get('/', 'ServiceController@index')->name('index');
    Route::post('/store', 'ServiceController@store')->name('store');
    Route::get('/edit/{id}', 'ServiceController@edit')->name('edit');
    Route::post('/update', 'ServiceController@update')->name('update');
    Route::get('/delete/{id}', 'ServiceController@delete')->name('delete');
});



Route::prefix("promotional_banners")->group(function () {
    Route::get('/', 'PromotionalBannersController@getBanners');
    Route::post('update', 'PromotionalBannersController@updateBanners');
    Route::delete('1', 'PromotionalBannersController@deleteBanner1');
    Route::delete('2', 'PromotionalBannersController@deleteBanner2');
});

// service route
Route::middleware([CheckForNormalAdmin::class])->prefix('normal_admin')->name('normal_admin.')->group(function () {
    Route::get('/', 'NormalAdminController@index')->name('index');
    Route::get('/create', 'NormalAdminController@create')->name('create');
    Route::post('/store', 'NormalAdminController@store')->name('store');
    Route::get('/{uuid}/edit', 'NormalAdminController@edit')->name('edit');
    Route::post('/update', 'NormalAdminController@update')->name('update');
    Route::get('/{uuid}/delete/', 'NormalAdminController@destroy')->name('delete');
});


require __DIR__ . '/auth.php';
