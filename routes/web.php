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
Route::get('/test/excel', function() {
  Excel::create('test', function($excel) {
    
      // Call writer methods here
      $excel->sheet('Sheetname', function($sheet) {

        $sheet->fromArray(array(
            array('data1', 'data2'),
            array('data3', 'data4')
        ));

      });
  
  })
  ->store('xls', storage_path(public_path() . 'excel'))  
  ->export('pdf');
  
});


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

  Route::get('/question/state/{id}', 'QuestionController@state_list')->name('q.state.list');
  Route::get('/question/download/excel/{id}', 'QuestionController@downloadExcel');
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
  

  /*
  ==================================================
  Choice
  ==================================================
  */
  Route::get('/choice', 'ChoiceController@index')->name('c.index');
  Route::get('/choice/search', 'ChoiceController@search')->name('c.search');
  Route::post('/choice', 'ChoiceController@store')->name('c.store');
  Route::get('/choice/{id}/edit', 'ChoiceController@edit')->name('c.edit');
  Route::put('/choice/{id}', 'ChoiceController@update')->name('c.update');
  Route::get('/choice/create', 'ChoiceController@create')->name('c.create');
  Route::delete('/choice/{id}', 'ChoiceController@destroy')->name('c.destroy');
  



});
Auth::routes();

Route::get('/{lang}/finish', 'QuestionController@finish_page')->name('finish.page');
Route::post('/finish', 'QuestionController@finish')->name('finish');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{lang}/{id}', 'QuestionController@show')->name('q.show');
Route::get('/{lang}/{id}/{choice_id}', 'QuestionController@test')->name('q.test');
Route::post('/{lang}/{id}/{choice_id}', 'QuestionController@result')->name('q.result');

Route::post('/{lang}/test/{id}', 'HomeController@answer')->name('answer');

