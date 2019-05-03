<?php

namespace App\Http\Controllers;


use App\Http\Requests\PaymentValidate;
use App\Payment;
use App\Program;
use Illuminate\Http\Request;


class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::paginate(15);

//        dd($payments);

        return view('payment.Index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $programs = Program::with('trainees')->get();

        return view('payment.Create',compact('programs'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentValidate $request)
    {

        foreach ($request->row as $item)
        {

            if (!is_null($item['amount']))
            {
                $trainee_id = $request->trainee_name;
                $trainee_name = $request->trainee_name_hidden;
                $payment_amount =  $item['amount'];
                $program_id = $item['program_id'];
                $program_title = $item['program_title'];
                Payment::create(compact('trainee_id', 'trainee_name', 'payment_amount', 'program_id', 'program_title'));
            }

        }

        // $payment = Payment::create($request->all());

        return redirect('payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $req)
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
        //
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
        //
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
