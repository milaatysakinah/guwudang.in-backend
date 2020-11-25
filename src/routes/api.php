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

Route::resource('product', 'App\Http\Controllers\ProductController');
Route::get('searchProduct','App\Http\Controllers\ProductController@search');
Route::get('searchProductByUserID','App\Http\Controllers\ProductController@searchByUserID');
Route::get('product','App\Http\Controllers\ProductController@product');
Route::get('productStock','App\Http\Controllers\ProductController@productStock');
Route::get('productall', 'App\Http\Controllers\ProductController@productAuth')->middleware('jwt.verify');

Route::resource('users', 'App\Http\Controllers\UserController');
/*
Route::get('product','App\Http\Controllers\ProductController@index');
Route::post('product','App\Http\Controllers\ProductController@create');
Route::put('product','App\Http\Controllers\ProductController@update');
Route::delete('product','App\Http\Controllers\ProductController@destroy');
*/
Route::resource('orderitem', 'App\Http\Controllers\OrderItemController');
Route::get('searchOrderItemByUserID','App\Http\Controllers\OrderItemController@searchByUserID');
Route::get('weeklyOrderItem','App\Http\Controllers\OrderItemController@weeklyData');

Route::resource('partner', 'App\Http\Controllers\PartnerController');
Route::get('searchPartner','App\Http\Controllers\PartnerController@search');
Route::get('searchPartnerByUserID','App\Http\Controllers\PartnerController@searchByUserID');

Route::resource('invoice', 'App\Http\Controllers\InvoicesController');
Route::get('searchInvoiceByUserID','App\Http\Controllers\InvoicesController@searchByUserID');

Route::post('login', 'App\Http\Controllers\LoginController@login');
Route::post('register', 'App\Http\Controllers\LoginController@register');
Route::get('authUser', 'App\Http\Controllers\LoginController@getAuthenticatedUser')->middleware('jwt.verify');

Route::resource('productDetail', 'App\Http\Controllers\ProductDetailController');
Route::get('productDetailByProductID','App\Http\Controllers\ProductDetailController@searchProductID');

Route::resource('productType', 'App\Http\Controllers\ProductTypeController');
Route::resource('status', 'App\Http\Controllers\StatusController');
Route::resource('transactionType', 'App\Http\Controllers\TransactionTypeController');