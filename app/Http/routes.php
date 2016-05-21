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

/*
|--------------------------------------------------------------------------
| News pages
|--------------------------------------------------------------------------
*/

Route::get('/', 'MainController@index');

Route::get('/add_news', 'MainController@addNews');

Route::get('/news/{id}', 'NewsController@index');

Route::get('/edit_news/{id}', 'NewsController@editNews');

/*
|--------------------------------------------------------------------------
| Ajax call routes
|--------------------------------------------------------------------------
*/

Route::post('/add_news_post', 'NewsController@addNews');

Route::post('/delete_news_post', 'NewsController@deleteNews');

Route::post('/update_news_post', 'NewsController@updateNews');

/*
|--------------------------------------------------------------------------
| Login page
|--------------------------------------------------------------------------
*/

Route::get('login', 'LoginController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
