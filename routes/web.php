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
  Route::get('/question', 'QuestionController@index')->name('q.index');
  Route::get('/question/search', 'QuestionController@search')->name('q.search');
  Route::post('/question', 'QuestionController@store')->name('q.store');
  Route::get('/question/{id}/edit', 'QuestionController@edit')->name('q.edit');
  Route::put('/question/{id}', 'QuestionController@update')->name('q.update');
  Route::get('/question/create', 'QuestionController@create')->name('q.create');
  Route::delete('/question/{id}', 'QuestionController@destroy')->name('q.destroy');

  /*
  ==================================================
  Answer
  ==================================================
  */
  Route::get('/answer', 'AnswerController@index')->name('a.index');
  Route::get('/answer/search', 'AnswerController@search')->name('a.search');
  Route::post('/answer', 'AnswerController@store')->name('a.store');
  Route::get('/answer/{id}/edit', 'AnswerController@edit')->name('a.edit');
  Route::put('/answer/{id}', 'AnswerController@update')->name('a.update');
  Route::get('/answer/create', 'AnswerController@create')->name('a.create');
  Route::delete('/answer/{id}', 'AnswerController@destroy')->name('a.destroy');
  



});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{lang}/test/{id}', 'HomeController@test')->name('test');
Route::get('/{lang}/start', 'HomeController@start')->name('start');
Route::get('/{lang}/finish', 'HomeController@finish')->name('finish');
Route::post('/{lang}/test/{id}', 'HomeController@answer')->name('answer');

