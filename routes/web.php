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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customer', 'CustomerController@add')->name('add');
Route::post('/add', 'CustomerController@addCustomer')->name('customer.add');
Route::get('/customer/list', 'CustomerController@list')->name('list');
Route::get('/customer/edit/{customer}', 'CustomerController@update')->name('edit');
Route::post('/customer/edit', 'CustomerController@updateCustomer')->name('update');
Route::delete('/customer/{customer}', 'CustomerController@delete')->name('delete');


