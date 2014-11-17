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

Route::get('/', ['uses' => 'HomeController@index']);

Route::group(['before' => 'ajax'], function() {
	Route::get('/home/main', ['as' => 'home.main', 'uses' => 'HomeController@main']);
	Route::get('/battery/all', ['as' => 'battery.all', 'uses' => 'BatteryController@all']);
	Route::post('/battery', ['as' => 'battery.create', 'uses' => 'BatteryController@create']);
	Route::get('/battery/{battery}/edit', ['as' => 'battery.edit', 'uses' => 'BatteryController@edit']);
	Route::put('/battery/{battery}', ['as' => 'battery.update', 'uses' => 'BatteryController@update']);
	Route::delete('/battery/{battery}', ['as' => 'battery.destroy', 'uses' => 'BatteryController@destroy']);
});