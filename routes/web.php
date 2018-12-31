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

Route::get('/', 'DashboardController@index')->name('dashboard.index');

Route::resource('/vendor', 'VendorController');
Route::get('/api/vendor', 'VendorController@vendorApi')->name('vendor.api');

Route::resource('/good_category', 'GoodCategoryController');
Route::get('/api/good_category', 'GoodCategoryController@goodCategoryApi')->name('good_category.api');

Route::resource('/good', 'GoodController');
Route::get('/api/good', 'GoodController@goodApi')->name('good.api');

Route::resource('/buy', 'BuyController')->except([
	'edit', 'update', 'destroy',
]);
Route::post('/buy/get_goods', 'BuyController@getVendorGoods')->name('buy.getVendorGoods');
Route::post('/buy/get_good', 'BuyController@getGood')->name('buy.getGood');
Route::post('/buy/cart', 'BuyController@cart')->name('buy.cart');
Route::get('/api/buy', 'BuyController@buyApi')->name('buy.api');

Route::resource('/sale', 'SaleController')->except([
	'edit', 'update', 'destroy',
]);
Route::post('/sale/cart', 'SaleController@cart')->name('sale.cart');
Route::get('/api/sale', 'SaleController@saleApi')->name('sale.api');

Route::get('/transaction', 'TransactionController@index')->name('transaction.index');
Route::get('/api/transaction', 'TransactionController@apiTransaction')->name('transaction.api');