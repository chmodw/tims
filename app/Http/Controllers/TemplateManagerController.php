<?php

namespace App\Http\Controllers;

use App\TemplateManager;
use Illuminate\Http\Request;

class TemplateManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TemplateManager  $templateManager
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateManager $templateManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemplateManager  $templateManager
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplateManager $templateManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemplateManager  $templateManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemplateManager $templateManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TemplateManager  $templateManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemplateManager $templateManager)
    {
        //
    }
}
