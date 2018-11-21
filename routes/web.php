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
// INSTAGRAM FOLLOWERS TABLEs
Route::get('/instarank_abs', 'RankingsController@insta_absolute_ten');
Route::get('/instarank_pct', 'RankingsController@insta_percentage_ten');

// INSTA POSTS
Route::get('/instaprank_abs', 'RankingsController@instap_absolute_ten');
Route::get('/instaprank_pct', 'RankingsController@instap_percentage_ten');


// TWITTER FOLLOWERS TABLES
Route::get('/twitrank_abs', 'RankingsController@twitter_absolute_ten');
Route::get('/twitrank_pct', 'RankingsController@twitter_percentage_ten');
// YOUTUBE VIDEO VIEWS TABLES
Route::get('/youvrank_abs', 'RankingsController@yviews_absolute_ten');
Route::get('/youvrank_pct', 'RankingsController@yviews_percentage_ten');

// YOUTUBE SUBSCRIBERS TABLES
Route::get('/yousrank_abs', 'RankingsController@ysubs_absolute_ten');
Route::get('/yousrank_pct', 'RankingsController@ysubs_percentage_ten');


Route::get('/{id}','PageController@show');

Route::get('/reddit', 'RedditController@index');
Route::post('/reddit', 'RedditController@index');

Route::get('/youtube', 'YoutubeController@index');



