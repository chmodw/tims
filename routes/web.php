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

Route::get('/programs/local', 'LocalProgramController@index')->name('programs/local')->middleware('auth');

Route::POST('/programs/local', 'LocalProgramController@store')->name('programs/local')->middleware('auth');
/**
 * Show the Foreign Training Program Form
 */
Route::get('/programs/foreign', 'ForeignController@index')->name('programs/foreign')->middleware('auth');
/**
 * Handle the Foreign Training Program Form submition request
 */
Route::POST('/programs/foreign', 'ForeignController@store')->name('programs/foreign')->middleware('auth');

Route::get('/programs/inhouse', 'InHouseProgramController@index')->name('programs/inhouse')->middleware('auth');

Route::get('/programs/postgrad', 'PostGradProgramController@index')->name('programs/postgrad')->middleware('auth');

