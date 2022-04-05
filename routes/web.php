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
    return view('auth.login');
})->middleware('guest');

Route::get('/home', 'ShopController@index');

Route::group(['middleware' => ['auth']], function () {

Route::get('/mycart', 'ShopController@myCart');
Route::post('/mycart', 'ShopController@addMycart');
Route::post('/cartdelete', 'ShopController@deleteCart');
Route::post('/checkout', 'ShopController@checkout');

});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
