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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout')->middleware('checkApiToken');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'checkApiToken'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/produk/{id}', 'ProdukController@show')->name('public.produk.show');
    Route::post('/produk/{id}/buy', 'ProdukController@buy')->name('public.produk.buy');

    Route::get('/my-buy', 'BuyController@index')->name('public.buy');
});
