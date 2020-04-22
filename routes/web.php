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

Route::get ('/store', 'DataController@Store');
Route::get ('/', 'DataBrowser@index');
Route::post('/show', 'DataBrowser@update');
Route::get ('/show/{index}', 'DataBrowser@show');
Route::get ('/create', 'DataController@store');

