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

Route::get('/', 'PublicController@index');
Route::get('/detail/{id}', ['as'=>'detail.id','uses'=>'PublicController@detail']);
Route::get('/action', 'PublicController@action');
Route::get('/listgames', 'PublicController@listgames');
Route::get('/casino', 'PublicController@casino');
Route::get('/adventure', 'PublicController@adventure');
Route::get('/home', 'PublicController@index');
Route::get('/puzzle', 'PublicController@puzzle');
Route::get('/sports', 'PublicController@sports');
Route::get('/play/{id}', 'PublicController@play');
Route::get('/getDataBarChart', 'PublicController@getDataBarChart');

Route::group(['middleware' => 'auth'], function(){

	Route::get('/addgameaction', 'HomeController@addgameaction');
	Route::get('/addgamecasino', 'HomeController@addgamecasino');
	Route::get('/addgameadventure', 'HomeController@addgameadventure');
	Route::get('/addgamepuzzle', 'HomeController@addgamepuzzle');
	Route::get('/addgamesports', 'HomeController@addgamesports');
	Route::get('/addgame', 'HomeController@addgame');
	Route::post('/adddatagame', 'HomeController@adddatagame');
	Route::post('/addreviewgame', 'HomeController@addreviewgame');

});

//activation
Route::get('/user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
Route::auth();
