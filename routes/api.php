<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('programs/get/{programType}', 'ProgramController@get')->name('Programs.Get');

Route::get('sections/get/{WorkSpaceTypeName}',function ($WorkSpaceTypeName){

    $Section = \App\WorkSpaceType::select(['WorkSpaceTypeId','WorkSpaceTypeName'])->where('WorkSpaceTypeName',$WorkSpaceTypeName)->first();

    return $Section;
});

Route::get('user/{id}/assigned-programs',function ($id){

    $ProgrameSet = \App\Program::with('trainees')->where('trainee_id', $id)->get();

    $arr = [];

    foreach ($ProgrameSet as $item){
        $trainee_id = $item->trainees->NameWithInitial;
        $program_id = $item['program_id'];

        $type = $item['type'];

        $Sub_programe = [];

        switch ($type){
            case 'LocalProgram':
                   $Sub_programe =  \App\LocalProgram::where(['program_id'=>$program_id])->first();
                break;
            case 'x':
                //todo foriegn
                break;
            case 'y':
                //todo internal
                break;
        }

        $arr  [] = ['project' => $item, 'info' => $Sub_programe ];

    }

    return $arr;
});

Route::get('programs/get/{programType}', 'ApiController@getPrograms')->name('Programs.Get');
