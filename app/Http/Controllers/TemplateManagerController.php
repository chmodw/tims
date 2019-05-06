<?php

namespace App\Http\Controllers;

use App\Helpers;
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
        $templates = TemplateManager::paginate(20);

        return view('templates/index', ['templates' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templates/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'program_type' => 'required',
            'template_name' => 'required|max:50',
            'template' => 'required|file|max:5000|mimes:docx'
        ]);

        $uid = Helpers::u_id([$validated['template_name'],auth()->user()->email,$validated['program_type']]);
        //get the file ext
        $ext = $request->file('template')->getClientOriginalExtension();
        //save the file in the storage
        $fileName = $uid . "." . $ext;
        $savedFile = $request->file('template')->storeAs('templates', $fileName);

        if($savedFile){
            /**
             * save details in the database
             */
            $tmpmngr = new TemplateManager();
            $tmpmngr->name = $validated['template_name'];
            $tmpmngr->file_name = $fileName;
            $tmpmngr->program_type = $validated['program_type'];
            $tmpmngr->created_by = auth()->user()->email;

            $saved = $tmpmngr->save();

            if($saved){
                return redirect('/templatemanager')->with('success', ' The Template saved successfully');
            }else{
                return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not save the Template. please contact the administrator');
            }
        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not save the Template. please contact the administrator');
        }

    }

    /**
     * Download a specified Document.
     *
     * @param  \App\TemplateManager  $templateManager
     * @return \Illuminate\Http\Response
     */
    public function show($filename)
    {
        return response()->download(storage_path('app/templates/'.$filename));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemplateManager  $templateManager
     * @return \Illuminate\Http\Response
     */
    public function edit($filename)
    {
        $template = TemplateManager::where('file_name', $filename)->first();

        return view('templates/create', ['template_edit' => $template]);
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
