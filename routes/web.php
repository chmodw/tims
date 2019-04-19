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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('/trainees', 'TraineeController')->except('destroy', 'create', 'edit')->middleware('auth');

Route::get('/pdf/{programType}/{programId}', 'PdfController@create')->middleware('auth');


Route::get('local/get', 'LocalProgramController@getLocalPrograms');
Route::resource('local','LocalProgramController')->middleware('auth');

Route::get('foreign/get', 'ForeignProgramController@getForeignPrograms');
Route::resource('foreign','ForeignProgramController')->middleware('auth');

Route::resource('inhouse','LocalProgramController')->middleware('auth');
Route::resource('postgrad','LocalProgramController')->middleware('auth');

// Routes for Budget
Route::resource('budget','budgetController')->middleware('auth');
