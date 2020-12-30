<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('product', 'App\Http\Controllers\ProductController')->middleware('jwt.verify');
Route::get('searchProduct','App\Http\Controllers\ProductController@search')->middleware('jwt.verify');
Route::get('searchProductByUserID','App\Http\Controllers\ProductController@searchByUserID')->middleware('jwt.verify');
Route::get('product','App\Http\Controllers\ProductController@product')->middleware('jwt.verify');
Route::get('productStock','App\Http\Controllers\ProductController@productStock')->middleware('jwt.verify');
Route::get('productall', 'App\Http\Controllers\ProductController@productAuth')->middleware('jwt.verify');

Route::resource('users', 'App\Http\Controllers\UserController')->middleware('jwt.verify');
/*
Route::get('product','App\Http\Controllers\ProductController@index');
Route::post('product','App\Http\Controllers\ProductController@create');
Route::put('product','App\Http\Controllers\ProductController@update');
Route::delete('product','App\Http\Controllers\ProductController@destroy');
*/
Route::resource('orderitem', 'App\Http\Controllers\OrderItemController')->middleware('jwt.verify');
Route::get('searchOrderItemByUserID','App\Http\Controllers\OrderItemController@searchByUserID')->middleware('jwt.verify');
Route::get('weeklyOrderItem','App\Http\Controllers\OrderItemController@weeklyData')->middleware('jwt.verify');
Route::get('orderItemIN','App\Http\Controllers\OrderItemController@orderIN')->middleware('jwt.verify');
Route::get('orderItemOUT','App\Http\Controllers\OrderItemController@orderOUT')->middleware('jwt.verify');

Route::resource('partner', 'App\Http\Controllers\PartnerController')->middleware('jwt.verify');
Route::get('searchPartner','App\Http\Controllers\PartnerController@search')->middleware('jwt.verify');
Route::get('searchPartnerByUserID','App\Http\Controllers\PartnerController@searchByUserID')->middleware('jwt.verify');

Route::resource('invoice', 'App\Http\Controllers\InvoicesController')->middleware('jwt.verify');
Route::get('searchInvoice','App\Http\Controllers\InvoicesController@search')->middleware('jwt.verify');
Route::get('searchInvoiceByUserID','App\Http\Controllers\InvoicesController@searchByUserID')->middleware('jwt.verify');
Route::get('detail_invoice','App\Http\Controllers\InvoicesController@detail_invoice')->middleware('jwt.verify');
Route::get('detail_order','App\Http\Controllers\InvoicesController@detail_order')->middleware('jwt.verify');

Route::post('login', 'App\Http\Controllers\LoginController@login');
Route::post('register', 'App\Http\Controllers\LoginController@register');
Route::get('authUser', 'App\Http\Controllers\LoginController@getAuthenticatedUser')->middleware('jwt.verify');

Route::resource('productDetail', 'App\Http\Controllers\ProductDetailController')->middleware('jwt.verify');
Route::get('productDetailByProductID','App\Http\Controllers\ProductDetailController@searchProductID')->middleware('jwt.verify');

Route::resource('productType', 'App\Http\Controllers\ProductTypeController')->middleware('jwt.verify');
Route::resource('status', 'App\Http\Controllers\StatusController')->middleware('jwt.verify');
Route::resource('transactionType', 'App\Http\Controllers\TransactionTypeController')->middleware('jwt.verify');