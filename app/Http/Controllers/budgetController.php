<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Section;
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
        $budgets = Budget::all();
        $sections = Section::all();
        return view('budget.main',compact('sections'),compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $budgets = Budget::all();

        $sections = Section::all();

        return view('budget.createBudget',compact('budgets'), compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $budgets = Budget::where("section_id", $request->get("section_id"))->get();

        if ($budgets->isNotEmpty()) {
            dd("Section has an allocated budget already.");
        }

        Budget::create($request->except(["_token"]));


        return redirect('budget');
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
        $budgets =Budget::findOrFail($id);

        return view('budget.editBudget',compact('budgets'));
//        $sections = Section::findOrFail($id);
//
//        return view('budget.editBudget',compact('sections'));
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

        $budgets = Budget::findOrFail($id);

        $budgets->update($request->all());

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
}
