<?php
/**
 * This controller handles all the four types of programs
 */

namespace App\Http\Controllers;

use App\Organisation;
use App\Program;
use App\Trainee;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($programType)
    {

        if (file_exists(base_path() . '/App/' . $programType . '.php')) {

            return view('programs/' . $programType . '/Index');

        } else {

            return abort(404);

        }

    }

    /**
     * Return programs as jason
     *
     * @param $programType
     * @throws \Exception
     */
    public function get($programType)
    {

    }

    public function getTraineesData($programType, $programId)
    {
        $model = Program::where('program_id', $programId)->where('type', $programType);
        $json = Datatables()->of($model)->toJson();
        return $json;
    }

    public function addTrainee(Request $request)
    {

        /**
         * save trainee on the programs database
         */
        $program = new Program();

        $program->trainee_id = $request['userId'];
        $program->program_id = $request['programId'];
        $program->recommendation = $request['recommendation'];
        $program->type = $request['type'];

        /**
         * ADD CREATED BY
         */
//        $postGrad->createdBy = auth()->user()->email;
        $program->save($request->all());

        return back()->with('status', "Trainee Added successfully");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($programType)
    {
        $orgs = app('App\Http\Controllers\OrganisationController')->index();

        if (file_exists(base_path() . '/App/' . $programType . '.php')) {

            return view('programs/' . $programType . '/create')->with('orgs', $orgs);

        } else {
            return abort(404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (file_exists(base_path() . '/App/' . $request->program_type . '.php')) {

            if ($request->program_type == 'LocalProgram') {
                $this->validate(request(), $this->LocalFormValidation());
            } elseif ($request->program_type == 'InHouseProgram') {
                $this->validate(request(), $this->InHouseFormValidation());
            } elseif ($request->program_type == 'PostGradProgram') {
                $this->validate(request(), $this->PostGradFormValidation());
            } elseif ($request->program_type == 'ForeignProgram') {
                $this->validate(request(), $this->ForeignFormValidation());
            }

            $model = 'App\\' . $request->program_type;

            $data = array_merge(request()->all(), [
                'program_id' => $this->u_id([request()->program_title, auth()->user()->email, request()->program_type, request()->start_date]),
                'created_by' => auth()->user()->email,
                'nature_of_the_employment' => serialize($request->employment_nature),
                'employee_category' => serialize($request->employee_category),

            ]);
            /**
             * Add times to dates
             */
            if (array_key_exists('start_date', $data) && array_key_exists('start_time', $data)) {
                $data['start_date'] = $this->joint_date_time($data['start_date'], $data['start_time']);
            }
            if (array_key_exists('application_closing_date', $data) && array_key_exists('application_closing_time', $data)) {
                $data['application_closing_date_time'] = $this->joint_date_time($data['application_closing_date'], $data['application_closing_time']);
            }
            if (array_key_exists('employment_nature', $data)) {
                $emp = serialize($data['employment_nature']);
                $data['employment_nature'] = $emp;
            }
            if (array_key_exists('employee_category', $data)) {
                $data['employee_category'] = serialize($data['employee_category']);
            }
            /**
             * Save the organization in the organizations table and get the id
             */
            if (array_key_exists('organised_by_id', $data)) {

                if(is_null(Organisation::where('organisation_id', $data['organised_by_id'])->first())){
                    $orgId = $this->u_id([$data['organised_by_id'], auth()->user()->email, request()->program_type]);
                    Organisation::create(['organisation_id' => $orgId, 'name' => $data['organised_by_id'], 'created_by' => auth()->user()->email]);
                    $data['organised_by_id'] = $orgId;
                }
            }
            //  check if a program brochure is present
            if ($request->file('program_brochure') != null) {
                //get the file ext
                $ext = $request->file('program_brochure')->getClientOriginalExtension();
                //save the file in the storage
                $fileName = $data['program_id'] . "." . $ext;
                $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
                $finalData = array_merge(request()->all(), [
                    'program_brochure' => $fileName,
                ]);
            }
            /**
             * Save the data
             */
            $saved = $model::create($data);

            if(!$saved){
                return 'save faild';
            }

            if (request()->input('_submit') == 'redirect') {
                return redirect('/programs/' . request()->program_type)->with('status', 'Program has been saved successfully');
            } else {
                return back()->with('success', "Program has been saved successfully");
            }
        } else {
            return abort(404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Program $program
     * @return \Illuminate\Http\Response
     */
    public function show($programType, $programId)
    {

        if (file_exists(base_path() . '/App/' . $programType . '.php')) {

            $model = 'App\\' . $programType;

            $tbl = $model::getTableName();

            $program = $model::join('organisations', 'organisations.organisation_id', $tbl.'.organised_by_id')
                        ->where('program_id', $programId)
                        ->select($tbl.'.program_id', $tbl.'.program_title', $tbl.'.target_group', $tbl.'.start_date', $tbl.'.duration', $tbl.'.application_closing_date_time', $tbl.'.nature_of_the_employment', $tbl.'.employee_category', $tbl.'.venue',$tbl.'.is_long_term', $tbl.'.program_fee', $tbl.'.non_member_fee', $tbl.'.member_fee',$tbl.'.student_fee', $tbl.'.brochure_url', 'organisations.name')
                        ->get();

            return view('programs.' . $programType . '.show')->with(compact('program'));

        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Program $program
     * @return \Illuminate\Http\Response
     */
    public function edit($programType, $programId)
    {
        if (file_exists(base_path() . '/App/' .$programType. '.php')) {

            $model = 'App\\' . $programType;
            $tbl = $model::getTableName();
            $orgs = app('App\Http\Controllers\OrganisationController')->index();

            if($programType == 'LocalProgram') {
                $program = $this->getLocalProgram($programId, $model, $tbl);
            }

            return view('programs.' . $programType . '.edit')->with(compact('program'))->with(compact('orgs'));

        }else {
            return abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Program $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->program_type == 'LocalProgram') {
            $this->validate(request(), $this->LocalFormValidation());
        } elseif ($request->program_type == 'InHouseProgram') {
            $this->validate(request(), $this->InHouseFormValidation());
        } elseif ($request->program_type == 'PostGradProgram') {
            $this->validate(request(), $this->PostGradFormValidation());
        } elseif ($request->program_type == 'ForeignProgram') {
            $this->validate(request(), $this->ForeignFormValidation());
        }

        $model = 'App\\' . $request->program_type;

        $data = array_merge(request()->all(), [
            'updated_by' => auth()->user()->email,
            'nature_of_the_employment' => serialize($request->employment_nature),
            'employee_category' => serialize($request->employee_category),

        ]);
        /**
         * Add times to dates
         */
        if (array_key_exists('start_date', $data) && array_key_exists('start_time', $data)) {
            $data['start_date'] = $this->joint_date_time($data['start_date'], $data['start_time']);
        }
        if (array_key_exists('application_closing_date', $data) && array_key_exists('application_closing_time', $data)) {
            $data['application_closing_date_time'] = $this->joint_date_time($data['application_closing_date'], $data['application_closing_time']);
        }
        if (array_key_exists('employment_nature', $data)) {
            $emp = serialize($data['employment_nature']);
            $data['employment_nature'] = $emp;
        }
        if (array_key_exists('employee_category', $data)) {
            $data['employee_category'] = serialize($data['employee_category']);
        }
        /**
         * Save the organization in the organizations table and get the id
         */
        if (array_key_exists('organised_by_id', $data)) {

            if(is_null(Organisation::where('organisation_id', $data['organised_by_id'])->first())){
                $orgId = $this->u_id([$data['organised_by_id'], auth()->user()->email, request()->program_type]);
                Organisation::create(['organisation_id' => $orgId, 'name' => $data['organised_by_id'], 'created_by' => auth()->user()->email]);
                $data['organised_by_id'] = $orgId;
            }
        }
        //  check if a program brochure is present
        if ($request->file('program_brochure') != null) {
            //get the file ext
            $ext = $request->file('program_brochure')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $data['program_id'] . "." . $ext;
            $savedFile = $request->file('program_brochure')->storeAs('public/brochures', $fileName);
            $finalData = array_merge(request()->all(), [
                'program_brochure' => $fileName,
            ]);
        }
        //remove unwanted data before update
        $data = $this->array_un_setter($data, ['_method','_token','program_type','employment_nature','program_id','start_time', '_submit','application_closing_time','application_closing_date']);
        /**
         * Save the data
         */
        $saved = $model::where('program_id', request()->program_id)->update($data);

        if(!$saved){
            return 'save faild';
        }

        if (request()->input('_submit') == 'redirect') {
            return redirect('/programs/' . request()->program_type)->with('status', 'Program has been saved successfully');
        } else {
            return back()->with('success', "Program has been saved successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Program $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $request;
    }

    /**
     * get allocated trainees for a program
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trainee($programType, $programId)
    {

        $traineeIds = Program::where('program_id', $programId)
            ->where('type', 'LocalProgram')->get('trainee_id')
            ->toArray();

        return $traineeIds;




//        $program = $model::join('organisations', 'organisations.organisation_id', $tbl.'.organised_by_id')
//            ->where('program_id', $programId)
//            ->select($tbl.'.program_id', $tbl.'.program_title', $tbl.'.target_group', $tbl.'.start_date', $tbl.'.duration', $tbl.'.application_closing_date_time', $tbl.'.nature_of_the_employment', $tbl.'.employee_category', $tbl.'.venue',$tbl.'.is_long_term', $tbl.'.program_fee', $tbl.'.non_member_fee', $tbl.'.member_fee',$tbl.'.student_fee', $tbl.'.brochure_url', 'organisations.name')
//            ->get();

//        $trainees = Trainee::join('cmn_WorkSpace', 'cmn_WorkSpace.WorkSpaceId')
//        $trainees = Trainee::whereIn('EmployeeId', $traineeIds)
//            ->where('IsActive', 1)
//            ->join('cmn_WorkSpace', 'cmn_EmployeeVersion.WorkSpaceId', '=', 'cmn_WorkSpace.WorkSpaceId')
////                        ->select('Initial','name','DesignationId','WorkSpaceId','AGMWorkSpaceId','DGMWorkSpaceId')
////
////            ->join('orders', 'users.id', '=', 'orders.user_id')
//            ->get();


//        $id = Workspace::where('WorkspaceID', $trainees[0]['AGMWorkSpaceId'])->get('WorkSpaceTypeId');
//
//        return WorkSpaceType::where('WorkSpaceTypeId', $id[0]['WorkSpaceTypeId'])->get();

//        return $trainees;

//        return ;
//


        $trainees = [];
//        foreach($traineeIds as $id){
//            $trainee = Employer::where('EmployeeId', $id)->get(['NameWithInitial','DesignationId','DateOfAppointment']);
//            $trainees[] = $trainee;
//        }
//
        return view('programs.'.$programType.'.trainee')->with('program_id', $programId)->with('program_type', $programType)->with(compact('trainees'));
    }


    private function LocalFormValidation()
    {

        return [
            'program_title' => 'required|max:255',
            'organised_by_id' => 'required|max:255',
            'target_group' => 'required|max:255',
            'start_date' => 'required|max:255|date|after_or_equal:today',
            'start_time' => 'required|max:255',
            'end_date' => 'max:255|date|after_or_equal:start_date',
            'end_time' => 'max:255',
            'employment_nature' => 'required',
            'employee_category' => 'required|max:255',
            'venue' => 'required',
            'duration' => 'required',
            'application_closing_date' => 'required|max:191|before_or_equal:start_date',
            'application_closing_time' => 'required|max:255',
            'non_member_fee' => 'max:100',
            'member_fee' => 'max:100',
            'student_fee' => 'max:100',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }

    private function ForeignFormValidation()
    {
        return [
            'program_title' => 'required|max:255',
            'organised_by_id' => 'required|max:255',
            'notified_by' => 'required|max:255',
            'target_group' => 'required|max:255',
            'nature_of_the_appointment' => 'required|max:255',
            'employee_category' => 'required|max:255',
            'venue' => 'required|max:255',
            'currency' => 'required|max:255',
            'course_fee' => 'required|max:255',
            'start_date' => 'required|max:255|date|after_or_equal:today',
            'end_date' => 'max:255|date|after_or_equal:start_date',
            'application_closing_date_time' => 'required|max:255',
            'duration' => 'required|max:255',
            'created_by' => 'required|max:255',
            'updated_by' => 'required|max:255',
            'program_brochure' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ];
    }

    private function PostGradFormValidation()
    {
        return [];
    }

    private function InHouseFormValidation()
    {
        return [];
    }

    /**
     * generates a unique id from given data
     */
    private function u_id(Array $params)
    {
        array_push($params, date("M,d,Y h:i:s A"), rand(1, 9999999));
        $str = implode($params);
        $str = str_replace(",", "", $str);
        $str = str_replace(":", "", $str);
        $str = str_replace(" ", "", $str);

        return md5($str);
    }

    /**
     * @param $date
     * @param $time
     * @return false|string
     */
    private function joint_date_time($date, $time)
    {
        $timestamp = strtotime($date . " " . $time);

        return date("Y-m-d H:i:s", $timestamp);
    }

    private function array_un_setter(Array $array, Array $params)
    {
        foreach ($params as $param) {
            if (array_key_exists($param, $array)) {
//                $index = array_search($param, array_keys($array));
//                $array = array_splice($array, $index, $index);
                unset($array[$param]);
            }
        }
        return $array;
    }

    private function getLocalProgram($programId, $model, $tbl)
    {
            $program = $model::join('organisations', 'organisations.organisation_id', $tbl . '.organised_by_id')
                ->select($tbl . '.program_id', $tbl . '.program_title', $tbl . '.organised_by_id', $tbl . '.target_group',$tbl . '.start_date',$tbl . '.duration', $tbl . '.application_closing_date_time',$tbl . '.nature_of_the_employment',$tbl . '.employee_category', $tbl . '.venue',$tbl . '.is_long_term',$tbl . '.program_fee', $tbl . '.non_member_fee', $tbl . '.member_fee', $tbl . '.student_fee', $tbl . '.brochure_url',  'organisations.organisation_id', 'organisations.name')
                ->where('program_id', $programId)
                ->get();
        return $program;
    }
}
