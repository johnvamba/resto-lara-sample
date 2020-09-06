<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v0.1', 'namespace' => 'Api'], function() {
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');
	Route::group(['middleware' => 'auth:api'], function() {
		Route::get('getUser', 'AuthController@getUser')->name('api.getuser');
	});

	Route::group(['namespace' => 'Reservation'], function() {
		Route::name('api')->resource('space', 'SpaceController');

		Route::post('reserve_transact/{reserve_transact}/approve', 'ReserveTransactionController@approve');
		Route::post('reserve_transact/{reserve_transact}/confirm', 'ReserveTransactionController@confirm');
		Route::post('reserve_transact/{reserve_transact}/cancel', 'ReserveTransactionController@cancel');

		Route::name('api')->resource('reserve_transact', 'ReserveTransactionController');

		Route::name('api')->resource('reserve_history', 'ReserveTransactionHistoryController');
	});
});

// Route::group(['prefix'])