<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Http\Requests\TraineeRequestForm;
use App\Section;
use App\Trainee;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainees/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Get the designations from the database
        $designations = Designation::all(['id', 'designationName']);
        // get the sections from the database
        $sections = Section::all(['id', 'sectionName']);


        return view('trainees/create', ['designations' => $designations, 'sections' => $sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TraineeRequestForm $request)
    {

        //id	latest_version	created_by	updatedBy	created_at
//ref_id	version	epf_no	title	name_with_initials	full_name	office_email	personal_email	mobile	telephone	birthday	grade	designation_id	section_id	nic	passport_no	passport_issued_on	passport_expire_on	meal_pref	nature_of_employment	date_of_employment	date_of_appointment	updatedBy	updated_at	deleted_at

//{"_token":"ThSBIGXcCRg3OXd5OCxf3N2TJgeWizECdjZ9QFql","title":"mr","nameWithInitials":null,"fullName":null,"epfNo":null,"officeEmail":null,"personalEmail":null,"mobile":null,"telephone":null,"birthday":null,"grade":null,"designation":"1","section":"1","nic":null,"passportNo":null,"passportIssuedOn":null,"passportExpireOn":null,"mealPreference":"vegan","natureOfEmployment":null,"dateOfEmployment":null,"dateOfAppointment":null,"submit":"Save"}

        $validated = $request->validated();

        $trainee = new Trainee([
            'epf_no' => $validated['epfNo'],
            'title'=> $validated['title'],
            'name_with_initials'=> $validated['nameWithInitials'],
            'full_name'=> $validated['fullName'],
            'office_email'=> $validated['officeEmail'],
            'personal_email'=> $validated['personalEmail'],
            'mobile'=> $validated['mobile'],
            'telephone'=> $validated['telephone'],
            'birthday'=> $validated['birthday'],
            'grade'=> $validated['grade'],
            'designation_id'=> $validated['designation'],
            'section_id'=> $validated['section'],
            'nic'=> $validated['nic'],
            'passport_no'=> $validated['passportNo'],
            'passport_issued_on'=> $validated['passportIssuedOn'],
            'passport_expire_on'=> $validated['passportExpireOn'],
            'meal_pref'=> $validated['mealPreference'],
            'nature_of_employment'=> $validated['natureOfEmployment'],
            'date_of_employment'=> $validated['dateOfEmployment'],
            'date_of_appointment'=> $validated['dateOfAppointment'],
        ]);

        $trainee->save();
//        return redirect('/shares')->with('success', 'Stock has been added');
        return back()->with('success', "Program has been saved successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
