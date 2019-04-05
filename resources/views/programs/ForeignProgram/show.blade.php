@extends('layouts.main')

@section('content-title', 'Foreign Program')

@section('content')

    {{--Messages--}}
    @include('layouts._alert')

    @include('layouts._addTrainee', ['programType' => 'ForeignProgram'])

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
                    <td colspan="3">{{$program[0]->applicationClosingDateTime}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @include('layouts._selectedTrainees')


@endsection
