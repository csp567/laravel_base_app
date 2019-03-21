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
		if( true == Auth::check() ) {
			return view('/home');
		}
		return view('auth/login');
	});

	Auth::routes();
	Route::get('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/profile', function(){
		if( true == Auth::check() ) {
			return view('profile/profile');
		}
		return view('auth/login');
	});

	Route::get('/profile/update', function(){
		return view('profile_update');
	});

	Route::get('/blank-page', function(){
		return view('blank_page');
	});

	Route::get( '/user/user-types', 'CUserTypesController@getActiveUserTypes' );
	Route::get( '/user', 'CUsers@getCreateUser' );

	Route::post( '/user/create-new-user', 'CUsers@postNewUser' );
	
	Route::post( '/create_user_type', 'CUserTypesController@createUser' );
	Route::post( '/delete-user-type', 'CUserTypesController@deleteUserType' );

	Route::resource('contact', 'ContactController');
	Route::post( '/contact/store', 'ContactController@store' );
	Route::post('/contact/{id}/edit','ContactController@update');
	Route::post('/contact/delete','ContactController@destroy');

	Route::post('/contact/share','ShareContactController@shareContact');
	Route::post('/user/all','ShareContactController@getContactsList');