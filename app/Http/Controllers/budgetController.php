<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Http\Requests\BudgetValidate;
use App\WorkSpaceType;
use Carbon\Carbon;

use Illuminate\Http\Request;

class budgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $budgets = Budget::with("getWorkSpaceTypeId")->get();

        $budgetData = $budgets->pluck( "budget_amount", "getWorkSpaceTypeId.WorkSpaceTypeName")->toJson();

        return view('budget.Index',compact('budgets', 'budgetData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $workSpaces = WorkSpaceType::all(); // get section_id and section_name

        return view('budget.Create',compact('workSpaces'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetValidate $request)
    {


//        $request->validate([
//            'section_Id'=> 'required',
//            'section_name' => 'required',
//            'budget_year' => 'required',
//            'budget_amount' => 'required'
//        ]);

        $submitedDate = Carbon::parse($request->budget_year);

        $submitedDate = $submitedDate->year;

        $CurrentRecords = Budget::where('section_name',$request->section_name)->where('budget_year','like','%'.$submitedDate.'%')->get();

        if(!$CurrentRecords->isEmpty()){
            return redirect('budget')->withErrors('Already Allocated...');
        }

        Budget::create($request->all());

        return redirect('budget')->with('status', "Budget has been saved successfully");


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

        $editBudget = Budget::where('id',$id)->get();

        return view('budget.edit',compact('editBudget'));



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
        $budget = Budget::findOrFail($id);

        $budget->update($request->all());

        return redirect('budget');
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

    //budget form validations
//    private function BudgetFormValidation(){
//        return [
//            'selection_Id' => 'required',
//            'section_name' => 'required',
//            'budget_year' => 'required|after_or_equal:today',
//            'budget_amount' => 'required|max:255',
//
//        ];
//    }

public function calculateActualAmount(){




}

}
