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
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/trainees', 'EmployerController')->except('destroy', 'create', 'edit');
Route::get('/pdf/{programType}/{programId}', 'PdfController@create')->middleware('auth');
Route::get  ('/home', 'HomeController@index')->name('home');
Route::get('local/get', 'LocalProgramController@getLocalPrograms');
Route::resource('local','LocalProgramController')->middleware('auth');
Route::get('foreign/get', 'ForeignProgramController@getForeignPrograms');
Route::resource('foreign','ForeignProgramController')->middleware('auth');
Route::resource('inhouse','LocalProgramController')->middleware('auth');
Route::resource('postgrad','LocalProgramController')->middleware('auth');
//Route::get  ('programs/{programType}', 'ProgramController@index')->name('programs')->middleware('auth');
//Route::get  ('programs/create/{programType}', 'ProgramController@create')->name('programs.create');
//Route::POST ('programs/create', 'ProgramController@store')->name('programs.create');
//Route::get  ('programs/edit/{programType}/{programId}', 'ProgramController@edit')->name('programs.edit');
//Route::PATCH  ('programs/update', 'ProgramController@update')->name('programs.update');
//Route::DELETE  ('programs/delete', 'ProgramController@destroy')->name('programs.delete');
//Route::get  ('programs/{programType}/{programId}', 'ProgramController@show')->name('programs.show');
//Route::POST ('programs/trainee', 'ProgramController@addTrainee')->name('programs.trainees');
Route::get  ('programs/trainee/{programType}/{programId}','ProgramController@trainee')->name('programs.LocalProgram.trainee');
Route::DELETE('/programs/delete', 'ProgramController@delete')->name('programs.delete')->middleware('auth');
// Routes for Budget
Route::resource('budget','budgetController')->middleware('auth');
//Routes for payment
Route::resource('payment','paymentController')->middleware('auth');