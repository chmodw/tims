<?php

namespace App\Http\Controllers;

use App\Budget;
use App\WorkSpaceType;
use DemeterChain\B;
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

        $budgets = Budget::paginate(15);
        return view('budget.Index',compact('budgets'));
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
    public function store(Request $request)
    {

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

}
