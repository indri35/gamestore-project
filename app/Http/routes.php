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

Route::get('/', 'HomeController@index');
Route::get('/detail/{id}', ['as'=>'detail.id','uses'=>'HomeController@detail']);
Route::get('/action', 'HomeController@action');
Route::get('/casino', 'HomeController@casino');
Route::get('/adventure', 'HomeController@adventure');
Route::get('/home', 'HomeController@index');
Route::get('/puzzle', 'HomeController@puzzle');
Route::get('/sports', 'HomeController@sports');
Route::get('/play', 'HomeController@play');

Route::group(['middleware' => 'auth'], function(){

	Route::get('/addgameaction', 'HomeController@addgameaction');
	Route::get('/addgamecasino', 'HomeController@addgamecasino');
	Route::get('/addgameadventure', 'HomeController@addgameadventure');
	Route::get('/addgamepuzzle', 'HomeController@addgamepuzzle');
	Route::get('/addgamesports', 'HomeController@addgamesports');
	Route::get('/addgame', 'HomeController@addgame');
	Route::post('/adddatagame', 'HomeController@adddatagame');

});

//activation
Route::get('/user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
Route::auth();
