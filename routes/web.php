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


Route::get('programs/{programType}', 'ProgramsController@index')->name('programs');
Route::get('programs/create/{programType}', 'ProgramsController@create')->name('programs.create');
Route::POST('programs/create', 'ProgramsController@store')->name('programs.create');