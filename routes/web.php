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
// \Auth::routes();

Route::group([
	'prefix'=>'admin', 
	'namespace'=> 'Admin'
],	function(){
	Route::get('/login', 'Auth\LoginController@showLoginForm')->middleware('guest:admin')->name('admin.login');
	Route::post('/login', 'Auth\LoginController@login')->middleware('guest:admin')->name('admin.login.post');

	Route::group(['middleware' => 'auth:admin'],
		function(){
		Route::get('/dashboard', 'Dashboard@index')->name('admin.dashboard');
	});
});

Auth::routes();
// Route::get('login', 'Auth\LoginController')->middleware('guest:user')->name('public.login');

Route::group([
	'middleware' => 'auth',
	'namespace' => 'Consumer'
], function(){

	Route::get('/home','Dashboard@index')->name('public.dashboard');
});

// Route::get('/home', 'HomeController@index')->name('home');
