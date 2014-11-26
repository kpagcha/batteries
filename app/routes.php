<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'root','uses' => 'HomeController@index']);

Route::group(['before' => 'ajax'], function() {
	Route::group(['before' => 'admin'], function() {
		Route::get('/battery/all', ['as' => 'battery.all', 'uses' => 'BatteryController@all']);
		Route::post('/battery', ['as' => 'battery.create', 'uses' => 'BatteryController@create']);
		Route::get('/battery/{battery}/edit', ['as' => 'battery.edit', 'uses' => 'BatteryController@edit']);
		Route::put('/battery/{battery}', ['as' => 'battery.update', 'uses' => 'BatteryController@update']);
		Route::delete('/battery/{battery}', ['as' => 'battery.destroy', 'uses' => 'BatteryController@destroy']);

		Route::get('/user', ['uses' => 'UserController@index']);
		Route::post('/user', ['uses' => 'UserController@create']);
		Route::delete('/user/{user}', ['uses' => 'UserController@destroy']);
	});

	Route::group(['before' => 'customer'], function() {
		Route::get('/cart', ['uses' => 'CartController@index']);
		Route::post('/cart', ['uses' => 'CartController@add']);
		Route::delete('/cart/{id}', ['uses' => 'CartController@destroy']);
		Route::post('/cart/changeAmount', ['uses' => 'CartController@changeAmount']);

		Route::get('/order/create', ['uses' => 'OrderController@create']);
	});

	Route::group(['before' => 'customer_or_account_manager'], function() {
		Route::get('/negotiation', ['uses' => 'NegotiationController@index']);
		Route::get('/negotiation/negotiation_form', ['uses' => 'NegotiationController@negotiationForm']);
		Route::get('/negotiation/counter_offer', ['uses' => 'NegotiationController@counterOfferForm']);
		Route::post('/negotiation/counter_offer', ['uses' => 'NegotiationController@counterOffer']);
		Route::post('/negotiation/complete', ['uses' => 'NegotiationController@complete']);
		Route::post('/negotiation/reject', ['uses' => 'NegotiationController@reject']);
	});

	Route::group(['before' => 'account_manager'], function() {
		Route::get('/negotiation/take', ['uses' => 'NegotiationController@take']);
	});

	Route::group(['before' => 'admin_or_account_manager'], function() {
		Route::get('/record', ['uses' => 'RecordController@index']);
	});

	Route::get('/home/main', ['as' => 'home.main', 'uses' => 'HomeController@main']);

	Route::get('/login', ['as' => 'login', 'uses' => 'UserController@login'])->before('guest');
	Route::post('/login', ['as' => 'signin', 'uses' => 'UserController@signin']);
	Route::get('/logout', ['as' => 'logout', 'uses' => 'UserController@logout'])->before('auth');
	Route::get('/signup', ['as' => 'register', 'uses' => 'UserController@register'])->before('guest');
	Route::post('/signup', ['as' => 'signup', 'uses' => 'UserController@signup']);

	Route::get('/battery/{id}', ['uses' => 'BatteryController@show']);
});