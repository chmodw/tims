<?php

namespace App\Http\Controllers;

use App\Program;

class PaymentController extends Controller
{
    /**
     * get all the current programs from the programs
     * @param $programId
     * @return mixed
     */
    private function getPrograms($programId)
    {
        return Program::where('program_id', $programId)->select('trainee_id','program_id','recommendation','type')->get();
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
        }

        return null;
    }

    private function processInhouse($programDetails, $programId)
    {
        $columns = ['section', 'per person'];

        $data = [];



//        return $programs;


//per_person_fee	"1000.0"
//resource_person
//
//cost	"1"
//
//other_costs
//0
//name	"food"
//value	"100"
//1
//name	"drinks"
//value	"200"



    }

    private function processLocal()
    {
        return 'hello';
    }

    private function processForeign()
    {
        return 'hello';
    }

    private function processPostGrad()
    {
        return 'hello';
    }

//allowances per day
//    section/unit
//    trainee count
//    others costs
//    program fee
//    total cost
//    actions
//        mark as payed


    /**
     * returns the payment data as datatable JSON
     * @param $programId
     */
    public function get($programId)
    {
//        return Datatables()->of($this->process($programId))
//            ->addIndexColumn()
//            ->toJson();
        return $this->process($programId);
    }
}
