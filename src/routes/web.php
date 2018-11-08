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

Route::get('newsupdate', 'Laraveldaily\Home\Controllers\Newsupdate@index');

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('feeds', 'Laraveldaily\Home\Controllers\FeedController@index');
    Route::get('feeds/{id}', 'Laraveldaily\Home\Controllers\FeedController@show');
    Route::get('feeds/category/{categorystr}/{pos}/{count}', 'Laraveldaily\Home\Controllers\FeedController@readfeeds');
    Route::post('feeds', 'Laraveldaily\Home\Controllers\FeedController@store');
    Route::put('feeds/{id}', 'Laraveldaily\Home\Controllers\FeedController@update');
    Route::delete('feeds/{id}', 'Laraveldaily\Home\Controllers\FeedController@delete');

    Route::get('history', 'Laraveldaily\Home\Controllers\HistoryController@index');
    Route::get('history/{id}', 'Laraveldaily\Home\Controllers\HistoryController@show');
    Route::get('history/selected/{user_id}', 'Laraveldaily\Home\Controllers\HistoryController@readhistory');
    Route::post('history', 'Laraveldaily\Home\Controllers\HistoryController@store');
    Route::put('history/{flag}', 'Laraveldaily\Home\Controllers\HistoryController@update');
    Route::delete('history/{id}', 'Laraveldaily\Home\Controllers\HistoryController@delete');

    Route::get('newsfeed', 'Laraveldaily\Home\Controllers\NewsfeedController@index');
    Route::get('newsfeed/{id}', 'Laraveldaily\Home\Controllers\NewsfeedController@show');
    Route::post('newsfeed/news/{pos}/{count}', 'Laraveldaily\Home\Controllers\NewsfeedController@readnews');
    Route::post('newsfeed', 'Laraveldaily\Home\Controllers\NewsfeedController@store');
    Route::put('newsfeed', 'Laraveldaily\Home\Controllers\NewsfeedController@update');
    Route::delete('newsfeed/{id}', 'Laraveldaily\Home\Controllers\NewsfeedController@delete');

    Route::get('category', 'Laraveldaily\Home\Controllers\CategoryController@index');
    Route::get('category/{id}', 'Laraveldaily\Home\Controllers\CategoryController@show');
    Route::post('category', 'Laraveldaily\Home\Controllers\CategoryController@store');
    Route::put('category', 'Laraveldaily\Home\Controllers\CategoryController@update');
    Route::delete('category/{id}', 'Laraveldaily\Home\Controllers\CategoryController@delete');

    Route::get('feeder', 'laraveldaily\home\HomeController@index');
    Route::get('feeder/{id}', 'laraveldaily\home\HomeController@show');
    Route::post('feeder/{flag}', 'laraveldaily\home\HomeController@store');
    Route::post('feeder/select/default', 'laraveldaily\home\HomeController@defaultselect');
    Route::put('feeder', 'laraveldaily\home\HomeController@update');
    Route::delete('feeder/{id}', 'laraveldaily\home\HomeController@delete');

    Route::get('detail', 'Laraveldaily\Home\DetailController@index');
    Route::get('detail/{id}', 'laraveldaily\home\DetailController@show');
    Route::post('detail/', 'laraveldaily\home\DetailController@store');
    Route::put('detail', 'laraveldaily\home\DetailController@update');
    Route::delete('detail/{id}', 'laraveldaily\home\DetailController@delete');

});

