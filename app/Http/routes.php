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

Route::get('/home', 'HomeController@index');

Route::get('/login', 'HomeController@login');

Route::get('/company', 'HomeController@company');

Route::get('/features', 'HomeController@features');

Route::get('/partners', 'HomeController@partners');

Route::get('/contact', 'HomeController@contact');

Route::get('/detail/{id}', ['as'=>'detail.id','uses'=>'HomeController@detail']);



