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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/trainees', 'EmployerController')->except('destroy', 'create', 'edit');

Route::get('/pdf/{programType}/{programId}', 'PdfController@create')->middleware('auth');

Route::get  ('/home', 'HomeController@index')->name('home');

Route::get('local/get', 'LocalProgramController@getLocalPrograms');
Route::resource('local','LocalProgramController')->middleware('auth');

Route::get('foreign/get', 'ForeignProgramController@getForeignPrograms');
Route::resource('foreign','ForeignProgramController')->middleware('auth');

Route::get('inhouse/get', 'InHouseProgramController@getInhousePrograms');
Route::resource('inhouse','InHouseProgramController')->middleware('auth');

Route::get('postgrad/get', 'PostGradProgramController@getInhousePrograms');
Route::resource('postgrad','PostGradProgramController')->middleware('auth');

Route::POST('trainee/find','TraineeController@find')->name('trainee.find')->middleware('auth');
Route::resource('trainee','TraineeController', ['except' => 'index'])->except('destroy', 'create', 'edit')->middleware('auth');
Route::get('trainee/index/{class}/{id}','TraineeController@index')->middleware('auth');

Route::resource('program','ProgramController', ['except' => 'index'])->middleware('auth');

// Routes for Budget
Route::resource('budget','budgetController')->middleware('auth');
//Routes for payment
Route::resource('payment','paymentController')->middleware('auth');