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

//Rota Index
Route::get('/', 'LoginController@index')->name('home');

//Rota de Login 
Route::post('/login','LoginController@login')->name('login');
Route::get('/logout','LoginController@logout')->name('logout');
Route::get('/home','LoginController@home')->name('home');

//Rotas do Administrador
Route::get('/admin','AdminController@homeAdmin')->name('admin.home');
Route::get('/admin/add','AdminController@formAdd')->name('admin.add');
Route::post('/admin/add/product','AdminController@confirmAdd')->name('admin.confirm.add');
Route::get('/admin/list/product','AdminController@listProducts')->name('admin.list.products');
Route::delete('/admin/delete/product/{id}','AdminController@deleteProduct')->name('admin.delete.product');
Route::get('/admin/edit/product/{id}','AdminController@editProduct')->name('admin.edit.product');
Route::put('/admin/update/product/{id}','AdminController@updateProduct')->name('admin.update.product');
Route::get('/admin/search','AdminController@searchProd')->name('admin.search');
Route::get('/admin/search/result','AdminController@resultSearch')->name('admin.search.result');
Route::get('/admin/list/sales','AdminController@listSalesAdmin')->name('list.sales.admin');
Route::get('/admin/sale/order','AdminController@orderSalesAdmin')->name('order.sale.admin');
Route::get('/admin/sale/{id}/details','AdminController@saleDetailsAdmin');
Route::get('/admin/list/seller','AdminController@analyseSeller')->name('list.seller');
Route::get('/admin/performance/seller/{id}', 'AdminController@performanceSeller');

//Rotas do Vendedor
Route::get('/seller','SellerController@homeSeller')->name('seller.home');
Route::get('/seller/list/product','SellerController@listProd')->name('seller.list.product');
Route::get('/seller/search/product','SellerController@searchProd')->name('seller.search.product');
Route::get('/seller/search/result','SellerController@searchResult')->name('seller.search.result');
Route::get('/seller/sale','SellerController@initSale')->name('seller.sale');
Route::get('/seller/sale/addProd','SellerController@addProduct')->name('sale.add.product');
Route::get('/seller/cart/list','SellerController@listCart')->name('list.cart');
Route::get('/seller/cart/remove/{id}', 'SellerController@removeCart')->name('cart.remove');
Route::get('/seller/discount/cart','SellerController@discountCart')->name('discount.cart');
Route::post('/seller/finish/sale','SellerController@confirmSale')->name('confirm.sale');
Route::get('/seller/conf/sale','SellerController@addSale')->name('add.sale');