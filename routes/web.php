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

Auth::routes();

Route::get('/', 'PageController@index');
Route::get('/news', 'PageController@news');

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/alexa','AlexaController@index');

// RANKING TABLES:
// ALEXA RANK TABLEs
Route::get('/alexarank_abs', 'RankingsController@alexa_absolute_ten');
Route::get('/alexarank_pct', 'RankingsController@alexa_percentage_ten');
// IMNSTAGRAM FOLLOWERS TABLEs
Route::get('/instarank_abs', 'RankingsController@insta_absolute_ten');
Route::get('/instarank_pct', 'RankingsController@insta_percentage_ten');

Route::get('/{id}','PageController@show');

