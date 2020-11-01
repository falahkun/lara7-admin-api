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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::middleware('auth:admin')->prefix('dashboard')->group(function() {
    Route::resource('/products', 'ProductController');
    Route::resource('/transactions', 'TransactionController');
});
Route::prefix('v1/oauth')->group(function() {
    Route::get('login', 'API\AuthController@getResponseProvider');
    Route::get('callback', 'API\AuthController@handleCallback');
});