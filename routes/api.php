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

Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/products', 'ProductController@index');
Route::post('/product/register', 'ProductController@store');
Route::put('/product/update', 'ProductController@update');
Route::put('/product/delete', 'ProductController@delete');
Route::get('/product/{id}', 'ProductController@getProductId');


Route::get('/users', 'UserController@index');
Route::post('/user/register', 'UserController@store');
Route::put('/user/update', 'UserController@update');
Route::put('/user/delete', 'UserController@delete');
