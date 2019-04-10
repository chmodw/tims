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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/trainees', 'TraineeController')->except('destroy', 'create', 'edit');

Route::get('/pdf/{programType}/{programId}', 'PdfController@create')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('programs/{programType}', 'ProgramsController@index')->name('programs');
Route::get('programs/create/{programType}', 'ProgramsController@create')->name('programs.create');
Route::POST('programs/create', 'ProgramsController@store')->name('programs.create');
Route::get('programs/get/{programType}', 'ProgramsController@get')->name('programs.get');
Route::get('programs/{programType}/edit/{programId}', 'ProgramsController@edit')->name('programs.edit');
Route::get('programs/{programType}/{programId}', 'ProgramsController@show')->name('programs.show');
Route::POST('programs/trainees', 'ProgramsController@addTrainee')->name('programs.trainees');
Route::get('programs/trainees/{programType}/{programId}', 'ProgramsController@getTrainees')->name('programs.LocalProgram.trainees');
//Route::POST('programs/trainees/{programType}/{programId}', 'ProgramsController@getTraineesData')->name('programs.trainees');


// Routes for Budget

Route::resource('budget','budgetController')->middleware('auth');
