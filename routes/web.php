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

Route::get('/programs', 'ProgramController@index')->name('program')->middleware('auth');

Route::get('/trainees', 'TraineeController@index')->name('Trainee')->middleware('auth');


/**
 * Local program routes
 */
Route::get('/programs/local', 'LocalProgramController@index')->name('programs/local')->middleware('auth');
Route::get('/programs/local/create', 'LocalProgramController@create')->name('programs/local/create')->middleware('auth');
Route::POST('/programs/local/store', 'LocalProgramController@store')->name('programs/local/store')->middleware('auth');
Route::get('/programs/local/{programId}', 'LocalProgramController@show')->name('programs/local/show')->middleware('auth');




/**
 * Show the Foreign Training Program Form
 */
Route::get('/programs/foreign/create', 'ForeignProgramController@create')->name('programs/foreign')->middleware('auth');
/**
 * Handle the Foreign Training Program Form submition request
 */
Route::POST('/programs/foreign/create', 'ForeignProgramController@store')->name('programs/foreign')->middleware('auth');

Route::get('/programs/foreign', 'ForeignProgramController@index')->name('programs/foreign')->middleware('auth');
/**
 * Show the new in house training program form
 */
Route::get('/programs/inhouse/create', 'InHouseProgramController@create')->name('programs/inhouse')->middleware('auth');
/**
 * handle the new in house program request form
 */
Route::POST('/programs/inhouse/create', 'InHouseProgramController@store')->name('programs/inhouse')->middleware('auth');

Route::get('/programs/inhouse', 'InHouseProgramController@index')->name('programs/inhouse')->middleware('auth');



Route::get('/programs/postgrad/create', 'PostGradProgramController@create')->name('programs/postgrad')->middleware('auth');


Route::POST('/programs/postgrad/create', 'PostGradProgramController@store')->name('programs/postgrad')->middleware('auth');

Route::get('/programs/postgrad', 'PostGradProgramController@index')->name('programs/postgrad')->middleware('auth');

