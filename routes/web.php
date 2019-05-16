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

/**
 * User registration
 */
Auth::routes();

/**
 * Home routes
 */
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');


/**
 * Trainee routes
 */
//Route::resource('/trainees', 'EmployerController')->except('destroy', 'create', 'edit')->middleware('auth');
//Route::resource('/trainees', 'EmployerController')->except('destroy', 'create', 'edit')->middleware('auth');
/**
 * Local Program Routes
 */
Route::get('local/get', 'LocalProgramController@getLocalPrograms')->middleware('auth');;
Route::resource('local','LocalProgramController')->middleware('auth');
/**
 * foreign Program Routes
 */
Route::get('foreign/get', 'ForeignProgramController@getForeignPrograms')->middleware('auth');;
Route::resource('foreign','ForeignProgramController')->middleware('auth');
/**
 * inhouse Program Routes
 */
Route::get('inhouse/get', 'InHouseProgramController@getInhousePrograms')->middleware('auth');;
Route::resource('inhouse','InHouseProgramController')->middleware('auth');

/**
 * Post-Grad Program Routes
 */
Route::get('postgrad/get', 'PostGradProgramController@getPostGradPrograms');
Route::resource('postgrad','PostGradProgramController')->middleware('auth');
/**
 * Employee Routes
 */
Route::get('employee/get', 'EmployeeController@getEmployee');
Route::resource('employee','EmployeeController')->middleware('auth')->except('destroy', 'create', 'edit')->middleware('auth');

/**
 * Trainee Routes
 */

Route::POST('trainee/find','TraineeController@find')->name('trainee.find')->middleware('auth');
Route::resource('trainee','TraineeController', ['except' => 'index'])->middleware('auth');
Route::get('trainee/index/{class}/{id}','TraineeController@index')->middleware('auth');
Route::get('trainee/getTrainee/{class}/{id}','TraineeController@getTrainee')->middleware('auth');
/**
 * Program Routes
 */
Route::get('program/findMyProgram/{programId}','ProgramController@findMyProgram')->name('program.findMyProgram')->middleware('auth');
Route::get('program/get','ProgramController@getPrograms')->name('program.get')->middleware('auth');
Route::resource('program','ProgramController', ['except' => 'index'])->middleware('auth');
Route::get('program/{class}/{id}','ProgramController@index')->name('program.index')->middleware('auth');
/**
 * Doc Routes
 */
Route::resource('doc','DocumentController')->middleware('auth');
Route::POST('doc/generate','DocumentController@generate')->name('doc.generate')->middleware('auth');

/**
 * Routes for Budget
 */
Route::resource('budget','budgetController')->middleware('auth');
/**
 * Routes for payment
 */
Route::resource('payment','paymentController')->middleware('auth');
/**
 * Template Routes
 */
Route::resource('templatemanager','TemplateManagerController')->middleware('auth');

//Route::get('users/getUsers','UserController@getUsers')->name('users.getUsers')->middleware('auth');
//Route::resource('users','UserController')->middleware('auth');


Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');