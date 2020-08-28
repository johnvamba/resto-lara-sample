<?php
// use Redis;
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
	// dd(Redis::connection());
	// return Redis::connection();
    return view('welcome');
});

Route::get('/test', 'TestController@test');

Route::group([
	// 'middleware'=> ['auth:admin'], 
	'prefix'=>'admin', 
	'namespace'=> 'Admin'
],	function(){
	Route::get('/', 'Dashboard@index')->name('admin.dashboard');
});

Route::group([
	// 'middleware' => ['auth:user'],
	'namespace' => 'Consumer'
], function(){
	Route::get('/','Dashboard@index')->name('public.dashboard');
});