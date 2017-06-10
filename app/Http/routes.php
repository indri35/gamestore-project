<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'], function(){

	Route::get('/home', 'HomeController@index');
	Route::get('/', 'HomeController@index');
	Route::get('/detail/{id}', ['as'=>'detail.id','uses'=>'HomeController@detail']);

	Route::get('/action', 'HomeController@action');
	Route::get('/addgameaction', 'HomeController@addgameaction');

	Route::get('/casino', 'HomeController@casino');
	Route::get('/addgamecasino', 'HomeController@addgamecasino');

	Route::get('/adventure', 'HomeController@adventure');
	Route::get('/addgameadventure', 'HomeController@addgameadventure');

	Route::get('/puzzle', 'HomeController@puzzle');
	Route::get('/addgamepuzzle', 'HomeController@addgamepuzzle');

	Route::get('/sports', 'HomeController@sports');
	Route::get('/addgamesports', 'HomeController@addgamesports');

	Route::get('/addgame', 'HomeController@addgame');
	Route::post('/adddatagame', 'HomeController@adddatagame');

});

//activation
Route::get('/user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
Route::auth();
