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


Auth::routes();

Route::get('/', 'LinkController@index')->name('home');
Route::post('/store', 'LinkController@store')->name('store');
Route::get('/links', 'LinkController@links')->name('links');
Route::get('/browsers', 'LinkController@browsers')->name('browsers');
Route::get('{id}/links', 'LinkController@topLinks')->name('top-links');
Route::get('{id}/browsers', 'LinkController@topBrowsers')->name('top-browsers');
Route::get('/links/{id}', 'LinkController@redir')->name('redir');