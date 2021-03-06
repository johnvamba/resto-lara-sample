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
	Route::get('/' , function(){
		return redirect()->route('admin.dashboard');
	});
	Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\LoginController@login')->name('admin.login.post');

	Route::group(['middleware' => 'auth:admin'],
		function(){
		Route::get('/dashboard', 'Dashboard@index')->name('admin.dashboard');
		Route::get('/reservation', 'Dashboard@reservation')->name('admin.reservation');
		Route::get('/reservation/{space}', 'Dashboard@reservation')->name('admin.reservation.space');

		Route::get('/transaction/{reserve_transact}', 'Dashboard@reserve_transact')->name('admin.reservation.history');

	});
});

Auth::routes();
// Route::get('login', 'Auth\LoginController')->middleware('guest:user')->name('public.login');

Route::group([
	'middleware' => 'auth',
	'namespace' => 'Consumer'
], function(){
	Route::get('/reserve','Dashboard@histories')->name('public.histories');

	Route::post('/reserve','ReservePost')->name('public.post');

	Route::get('/home','Dashboard@index')->name('public.dashboard');
});

// Route::get('/home', 'HomeController@index')->name('home');
