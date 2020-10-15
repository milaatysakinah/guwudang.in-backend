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
| vj
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/listCustomers', 'CustomersController@index');

Route::get('/listCustomers/search','CustomersController@search');

Route::get('/listCustomers/proses','CustomersController@proses');

Route::get('/listCustomers/create','CustomersController@create');
