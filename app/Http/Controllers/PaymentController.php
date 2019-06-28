<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

class PaymentController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
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
                    'member_total_cost' => 0, 'nonmember_total_cost' => 0, 'student_total_cost' => 0,'program_fee' => 0, 'total_cost' => 0
                ];
            }

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
}
