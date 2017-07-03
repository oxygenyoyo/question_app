<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::get('/', 'HomeController@guest')->name('guest');



Route::group(['prefix' => 'admin'], function () {


  /*
  ==================================================
  Question
  ==================================================
  */
  Route::get('/', 'QuestionController@index');
  Route::get('/question/search', 'QuestionController@search');
  Route::post('/question', 'QuestionController@store');
  Route::get('/question/{id}/edit', 'QuestionController@edit');
  Route::put('/question/{id}', 'QuestionController@update');
  Route::get('/question/create', 'QuestionController@create');
  Route::delete('/question/{id}', 'QuestionController@destroy');
  



});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{lang}/test/{id}', 'HomeController@test')->name('test');
Route::get('/{lang}/start', 'HomeController@start')->name('start');
Route::get('/{lang}/finish', 'HomeController@finish')->name('finish');
Route::post('/{lang}/test/{id}', 'HomeController@answer')->name('answer');

