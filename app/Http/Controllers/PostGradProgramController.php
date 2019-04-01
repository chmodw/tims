<?php
namespace App\Http\Controllers;
use App\ForeignProgram;
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
        $programs = PostGradProgram::paginate(10);

        return view('programs.PostGradProgram.index', compact('programs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.PostGradProgram.form');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostGradFromRequest $request)
    {
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
        $editProgram = PostGradProgram::where('programId', $id)->get();
        return view('programs.PostGradProgram.edit', compact('editProgram'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostGradFromRequest $request, $id)
    {

        $postGrad = PostGradProgram::find($id);

        $validated = $request->validated();

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
            $savedFile = $request->file('programBrochure')->storeAs('public/brochures', $validated['programId'].".".$ext);
            //save the file name in the database
            $postGrad->brochureUrl = $savedFile;
        }

        $postGrad->updatedBy = auth()->user()->email;
        $postGrad->save();

        return back()->with('success', "Program has been Updated successfully");
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