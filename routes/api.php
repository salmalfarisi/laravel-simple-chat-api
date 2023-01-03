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

Route::group(['prefix' => 'account', 'as' => 'Account.'], function () {
    Route::post('login', 'UserController@login')->name('login');
    Route::get('logout', 'UserController@logout')->name('logout')->middleware('token');
});

Route::group(['prefix' => 'chat', 'as' => 'Chat.', 'middleware' => 'token'], function () {
    Route::get('indexbychat/{id}', 'ChatController@indexbychat')->name('indexbychat');
    Route::get('show/{id}', 'ChatController@show')->name('show');
    Route::get('readstatus/{id}', 'ChatController@changeReadStatus')->name('changeReadStatus');
    Route::post('store', 'ChatController@store')->name('store');
});
