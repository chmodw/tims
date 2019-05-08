<?php

namespace App\Http\Controllers;

use App\ForeignProgram;
use App\Helpers;
use App\InHouseProgram;
use App\LocalProgram;
use App\PostGradProgram;
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

        $local = new LocalProgram();
        $foreign = new ForeignProgram();
        $postgrad = new PostGradProgram();
        $inhouse = new InHouseProgram();

        $templates = TemplateManager::paginate(16);

        return view('templates/index', [
            'templates' => $templates,
            'local_programs_cols' => $local->getTableColumns(),
            'foreign_programs_cols' => $foreign->getTableColumns(),
            'postgrad_programs_cols' => $postgrad->getTableColumns(),
            'inhouse_programs_cols' => $inhouse->getTableColumns(),
            ]);
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

        return view('templates/edit', ['template_edit' => $template]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemplateManager  $templateManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'program_type' => 'required',
            'template_name' => 'required|max:50',
            'template' => ''
        ]);

        $tmpmngr = TemplateManager::find($id);

        if(isset($validated['template'])){
            $uid = Helpers::u_id([$validated['template_name'],auth()->user()->email,$validated['program_type']]);
            //get the file ext
            $ext = $request->file('template')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $uid . "." . $ext;
            $savedFile = $request->file('template')->storeAs('templates', $fileName);
            $tmpmngr->file_name = $fileName;
        }

        $tmpmngr->name = $validated['template_name'];
        $tmpmngr->program_type = $validated['program_type'];
        $tmpmngr->created_by = auth()->user()->email;

        $saved = $tmpmngr->save();

        if($saved){
            return redirect('/templatemanager')->with('success', ' The Template Updated successfully');
        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not Update the Template. please contact the administrator');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TemplateManager  $templateManager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = TemplateManager::find($id)->delete();

        if($deletedRows > 0){
            return redirect('/templatemanager')->with('success', ' The Template has been successfully Deleted');
        }else{
            return back()->with('failed', "System Could not Delete the Requested Template");
        }
    }

    /**
     * @param $type
     */
    public function getTemplates($type)
    {
        return TemplateManager::where('program_type', $type)->select('id','name' ,'file_name','program_type')->get();
    }
}
