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

Route::resource('roles','RoleController')->middleware('auth');

Route::get('users/edit/{id}/{editwhat}','UserController@edit')->middleware('auth');
Route::resource('users','UserController')->except('edit')->middleware('auth');

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/trainees', 'EmployerController')->except('destroy', 'create', 'edit')->middleware('auth');

Route::resource('/trainees', 'EmployerController')->except('destroy', 'create', 'edit')->middleware('auth');;

Route::get('/pdf/{programType}/{programId}', 'PdfController@create')->middleware('auth');

Route::get  ('/home', 'HomeController@index')->name('home')->middleware('auth');;

Route::get('local/get', 'LocalProgramController@getLocalPrograms')->middleware('auth');;
Route::resource('local','LocalProgramController')->middleware('auth');

Route::get('foreign/get', 'ForeignProgramController@getForeignPrograms')->middleware('auth');;
Route::resource('foreign','ForeignProgramController')->middleware('auth');

Route::get('inhouse/get', 'InHouseProgramController@getInhousePrograms')->middleware('auth');;
Route::resource('inhouse','InHouseProgramController')->middleware('auth');

Route::get('employee/get', 'EmployeeController@getEmployee');
Route::resource('employee','EmployeeController')->middleware('auth')->except('destroy', 'create', 'edit')->middleware('auth');

Route::get('postgrad/get', 'PostGradProgramController@getPostGradPrograms');
Route::resource('postgrad','PostGradProgramController')->middleware('auth');

Route::POST('trainee/find','TraineeController@find')->name('trainee.find')->middleware('auth');
/**
 * Without Index
 */
Route::resource('trainee','TraineeController', ['except' => 'index'])->middleware('auth');
/**
 * Custom Trainee INDEX route
 */
Route::get('trainee/index/{class}/{id}','TraineeController@index')->middleware('auth');
Route::get('trainee/getTrainee/{class}/{id}','TraineeController@getTrainee')->middleware('auth');

Route::get('program/findMyProgram/{programId}','ProgramController@findMyProgram')->name('program.findMyProgram')->middleware('auth');
Route::get('program/get','ProgramController@getPrograms')->name('program.get')->middleware('auth');
Route::resource('program','ProgramController', ['except' => 'index'])->middleware('auth');
Route::get('program/{class}/{id}','ProgramController@index')->name('program.index')->middleware('auth');


/**
 * Docs Routes
 */
Route::resource('doc','DocumentController')->middleware('auth');
Route::POST('doc/generate','DocumentController@generate')->name('doc.generate')->middleware('auth');

// Routes for Budget
Route::resource('budget','budgetController')->middleware('auth');
//Routes for payment
Route::resource('payment','paymentController')->middleware('auth');

Route::resource('templatemanager','TemplateManagerController')->middleware('auth');

/**
 * Show images stored in the storage
 */
Route::get('storage/{filename}', 'ImageController@show')->middleware('auth');

Route::get('/clear-cache', 'SystemController@clearcache')->middleware('auth');