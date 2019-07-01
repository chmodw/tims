<?php

namespace App\Http\Controllers;

use App\Program;
use App\SectionPayment;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Style\Section;

class PaymentController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $paymentDetails = SectionPayment::find($request->id);
        $programData = $request->input();

        if(!empty($paymentDetails) && !empty($programData))
        {
            return view('programs/payments/show')->with('payment', unserialize($paymentDetails->payment_data))->with('details', $paymentDetails)->with('program_data', $programData);
        }

        return abort(404);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $program = unserialize($request->program);
        $payment = unserialize($request->payments);

        return view('programs/payments/create')->with('payment', $payment)->with('program' , $program);

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
            'payment_data' => 'required',
            'program_id' => 'required',
            'invoice_number' => 'required',
            'invoice_file' => 'mimes:doc,pdf,docx,jpg,jpeg,png|max:4999',
        ]);

        $payment =  unserialize($validated['payment_data']);

        $payments = new SectionPayment();

        $payments->program_id = $validated['program_id'];
        $payments->section_name = $payment['section'];
        $payments->payment_data = $validated['payment_data'];
        $payments->invoice_number = $validated['invoice_number'];

        if ($request->file('invoice_file') != null) {
            //get the file ext
            $ext = $request->file('invoice_file')->getClientOriginalExtension();
            //save the file in the storage
            $fileName = $validated['program_id'] . "-" . $payment['section'] .'.' . $ext;
            $savedFile = $request->file('invoice_file')->storeAs('public/payment_invoices', $fileName);
            $payments->invoice_file = $fileName;
        }

        $payments->created_by = auth()->user()->email;

        $saved = $payments->save();

        if($saved)
        {

            $programId = SectionPayment::find($payments->id)->get('program_id')->first()->program_id;
            $programType = Program::where('program_id', $programId)->first('type')->type;

            return redirect('/'.strtolower(str_replace('Program','',$programType)).'/'.$programId)->with('success', ' The Payment has been successfully Saved');

        }else{
            return Redirect::back()->withInput(Input::all())->with('failed ', ' System Could not save the Invoice.');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
    }

    /**
     * get all the current programs from the programs
     * @param $programId
     * @return mixed
     */
    private function getPrograms($programId)
    {
        return Program::where('program_id', $programId)->select('trainee_id','program_id','recommendation','type', 'member_type')->get();
    }

    /**
     * get the program details from the database
     * @param $programId
     * @return mixed
     */
    private function getProgramDetails($programId)
    {
        $programType = Program::where('program_id', $programId)->get('type')->first()->type;

        $model = app('App\\'.$programType);

        return ['program_details' => $model::where('program_id', $programId)->first(), 'program_type' => $programType] ;
    }

    /**
     * count the trainees by sections
     * @param $programId
     * @return array
     */
    private function count($programId)
    {
        $sectionCount = [];

        foreach ($this->getPrograms($programId) as $program)
        {
            if(!array_key_exists($program->recommendation, $sectionCount))
            {
                $sectionCount[$program->recommendation] = 1;
            }else{
                $sectionCount[$program->recommendation] +=1;
            }

        }

        return $sectionCount;
    }

    /**
     * Process
     * @param $programId
     */
    private function process($programId)
    {
        $programDetails = $this->getProgramDetails($programId);

        if($programDetails['program_type'] == 'InHouseProgram')
        {
            return $this->processInhouse($programDetails['program_details'], $programId);
        }elseif ($programDetails['program_type'] == 'LocalProgram')
        {
            return $this->processLocal($programDetails['program_details'], $programId);
        }

        return null;
    }

    private function processInhouse($programDetails, $programId)
    {

        return ;

    }

    private function processLocal($programDetails, $programId)
    {
        $count = [];

        // Count trainees by section
        foreach($this->getPrograms($programId) as $program)
        {
            //add the section as key
            if(!array_key_exists($program->recommendation, $count))
            {
                $count[$program->recommendation] = [
                    'member_count' => 0, 'nonmember_count' => 0, 'student_count' => 0, 'total_count' => 0,
                    'member_total_cost' => 0, 'nonmember_total_cost' => 0, 'student_total_cost' => 0,'program_fee' => 0, 'total_cost' => 0, 'paid' => false
                ];
            }
            //check if the payment has been paid

            $oldPayment = SectionPayment::where('program_id', $programId)->where('section_name',$program->recommendation)->first();
            if(!empty($oldPayment))
            {
                $count[$program->recommendation]['paid'] = $oldPayment->id;
            }
            //process the values member type
            if($program->member_type == 'Member')
            {
                $count[$program->recommendation]['member_count'] +=1;
                $count[$program->recommendation]['member_total_cost'] += $programDetails['member_fee'];
                $count[$program->recommendation]['program_fee'] += $programDetails['program_fee'];
                $count[$program->recommendation]['total_cost'] += $programDetails['program_fee'];
                $count[$program->recommendation]['total_cost'] += $programDetails['member_fee'];
            }elseif($program->member_type == 'Non-Member')
            {
                $count[$program->recommendation]['nonmember_count'] +=1;
                $count[$program->recommendation]['nonmember_total_cost'] += $programDetails['non_member_fee'];
                $count[$program->recommendation]['program_fee'] += $programDetails['program_fee'];
                $count[$program->recommendation]['total_cost'] += $programDetails['program_fee'];
                $count[$program->recommendation]['total_cost'] += $programDetails['non_member_fee'];
            }elseif($program->member_type == 'Student')
            {
                $count[$program->recommendation]['student_count'] +=1;
                $count[$program->recommendation]['student_total_cost'] += $programDetails['student_fee'];
                $count[$program->recommendation]['program_fee'] += $programDetails['program_fee'];
                $count[$program->recommendation]['total_cost'] += $programDetails['program_fee'];
                $count[$program->recommendation]['total_cost'] += $programDetails['student_fee'];
            }

            $count[$program->recommendation]['total_count'] += 1;



        }

        return $count;
    }

    private function processForeign()
    {
        return 'hello';
    }

    private function processPostGrad()
    {
        return 'hello';
    }

    /**
     * returns the payment data as datatable JSON
     * @param $programId
     */
    public function get($programId)
    {
        return $this->process($programId);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $programId = SectionPayment::find($id)->get('program_id')->first()->program_id;
        $programType = Program::where('program_id', $programId)->first('type')->type;

        return SectionPayment::find($id);

        $deletedRows = SectionPayment::find($id)->delete();

        if($deletedRows > 0){
            return redirect('/'.strtolower(str_replace('Program','',$programType)).'/'.$programId)->with('success', ' The Payment has been successfully Deleted');
        }else{
            return back()->with('failed', "System Could not Delete the Requested Payment");
        }
    }
}
