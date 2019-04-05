@extends('layouts.main')

@section('content-title', 'Programs')

@section('content')
    {{--Messages--}}
    @include('layouts._alert')

    @include('layouts._addTrainee' , ['programType' => 'PostGradProgram'])

    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">{{$program[0]->title}}</h4>
        </div>
        <div class="card-body  p-4">
            <div class="row">
                <div class="col col-md-6 mb-3">
                    <img src="https://www.visme.co/wp-content/uploads/2018/12/technology-brochure-template-visme.jpg" alt="" class="img-thumbnail">
                </div>
            </div>
            {{$program}}
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 15%">Institute</th>
                        <td colspan="3">{{$program[0]->institute}}</td>
                    </tr>
                    <tr>
                        <th style="width: 15%">Department</th>
                        <td colspan="3">{{$program[0]->department}}</td>
                    </tr>
                    <tr>
                        <th style="">Programs</th>
                        <td colspan="3">{{$program[0]->programs}}</td>
                    </tr>
                    <tr>
                        <th style="">Requirements</th>
                        <td colspan="3">{{$program[0]->requirements}}</td>
                    </tr>
                    <tr>
                        <th style="">Application Closing Date And Time</th>
                        <td>{{$program[0]->applicationClosingDateTime}}</td>
                        <th style="">Application Closing Date And Time</th>
                        <td>{{$program[0]->applicationClosingDateTime}}</td>
                    </tr>
{{--                    registrationFees":"10000.0","firstYearFees":"12255.0","secondYearFees":"4557.0"--}}
                    <tr>
                        <th style="">Registration Fees</th>
                        <td>{{$program[0]->applicationClosingDateTime}}</td>
                        <th style="">Application Closing Date And Time</th>
                        <td>{{$program[0]->applicationClosingDateTime}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    @include('layouts._selectedTrainees')

@endsection
