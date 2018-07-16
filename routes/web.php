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

Route::group(['middleware' => 'auth', 'prefix' => 'chat', 'as' => 'chat.'], function () {
  Route::get('general', 'ChatController@general')->name('general');
  Route::post('get-general', 'ChatController@get_general')->name('get-general');
  Route::post('send-general', 'ChatController@send_general')->name('send-general');
  Route::get('private', 'ChatController@private')->name('private');
  Route::get('test-private', 'ChatController@test_private')->name('test-private');
  Route::get('team', 'ChatController@team')->name('team');
  Route::get('test-team', 'ChatController@test_team')->name('test-team');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
