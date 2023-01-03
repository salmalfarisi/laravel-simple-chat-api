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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

/* Route::group(['prefix' => 'product', 'as' => 'Product.', 'middleware' => 'account.user'], function () {
    Route::get('index/{userid}', 'ProductController@indexbyuserid')->name('indexbyuserid');
    Route::post('store', 'ProductController@store')->name('store');
    Route::post('update/{id}', 'ProductController@update')->name('update');
}); */

Route::group(['prefix' => 'account', 'as' => 'Account.'], function () {
    Route::post('login', 'UserController@login')->name('login');
    Route::get('logout', 'UserController@logout')->name('logout')->middleware('token');
});
