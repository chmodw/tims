@extends('layouts.main')

@section('content-title', 'Programs')

@section('content')
    {{--Messages--}}
    @include('layouts._alert')

    @include('layouts._addTrainee' , ['programType' => 'LocalProgram'])

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
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th style="width: 15%">Origanised By</th>
                    <td colspan="3">{{$program[0]->organisedBy}}</td>
                </tr>
                <tr>
                    <th style="width: 15%">Target Group</th>
                    <td colspan="3">{{$program[0]->targetGroup}}</td>
                </tr>
                <tr>
                    <th style="width: 10%">start Date</th>
                    <td>{{$program[0]->startDate}}</td>
                    <th style="width: 20%">End Date</th>
                    <td>{{$program[0]->endDate}}</td>
                </tr>
                <tr>
                    <th style="width: 10%">Application Closing Date And Time</th>
                    <td>{{$program[0]->applicationClosingDateTime}}</td>
                    <th style="width: 10%">Non Member Fee (RS)</th>
                    <td>{{$program[0]->nonMemberFee}}</td>
                </tr>
                <tr>
                    <th style="width: 10%">Member Fee (RS)</th>
                    <td>{{$program[0]->memberFee}}</td>
                    <th style="width: 10%">Student Fee (RS)</th>
                    <td>{{$program[0]->studentFee}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="card-header">
            <div class="card-title">Available Documents</div>
        </div>
        <div class="card-body">
            <a href="/gen/{{$program[0]->programId}}/LocalProgram" class="btn btn-outline-primary">GM Approval Letter</a>
        </div>
    </div>

    @include('layouts._selectedTrainees')

@endsection
