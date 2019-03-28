<?php
namespace App\Http\Controllers;
use App\Http\Requests\PostGradFromRequest;
use App\PostGradProgram;
use Illuminate\Http\Request;
use App\Helper\Helper;

class PostGradProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.postgrad');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostGradFromRequest $request)
    {
//        'programTitle' => 'required|max:191',
//            'institute' => 'required|max:191',
//            'department' => 'required',
//            'programs' => 'required',
//            'requirements' => 'required|max:255',
//            'applicationClosingDate' => 'required|max:191|after_or_equal:today',
//            'applicationClosingTime' => 'required|max:191',
//            'registrationFees' => 'required|max:191',
//            'firstYearFees' => 'required|max:191',
//            'secondYearFees' => 'required|max:191',


        $validated = $request->validated();

        $postGrad = new PostGradProgram();

        $randomProgramId = Helper::uId([$validated['programTitle'],auth()->user()->email,$request->program_type]);

        $postGrad->programId = $randomProgramId;
        $postGrad->title = $validated['programTitle'];
        $postGrad->institute = $validated['institute'];
        $postGrad->department = $validated['department'];
        $postGrad->programs = Serialize(explode(', ', $validated['programs']));
        $postGrad->requirements = Serialize(explode(', ', $validated['requirements']));
        $postGrad->applicationClosingDateTime = Helper::jointDateTime($validated['applicationClosingDate'], $validated['applicationClosingTime']);
        $postGrad->registrationFees = $validated['registrationFees'];
        $postGrad->firstYearFees = $validated['firstYearFees'];
        $postGrad->secondYearFees = $validated['secondYearFees'];

        // check if a program brochure is present
        if($request->file('programBrochure') != null){
            //get the file ext
            $ext = $request->file('programBrochure')->getClientOriginalExtension();
            //save the file in the storage
            $savedFile = $request->file('programBrochure')->storeAs('public/brochures', $randomProgramId.".".$ext);
        }else{
            $savedFile = 'Null';
        }
        //save the file name in the database
        $postGrad->brochureUrl = $savedFile;
        $postGrad->createdBy = auth()->user()->email;
        $postGrad->save($validated);

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