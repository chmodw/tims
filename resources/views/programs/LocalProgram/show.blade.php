{{--search employees--}}
{{--add employees--}}
{{--show program results--}}

@extends('layouts.main')

@section('content-title', 'Programs')

@section('content')
    {{--Messages--}}
    @include('layouts._alert')

    <div class="card mb-3">
        <div class="card-header">
            Add Trainee
        </div>
        <div class="card-body">
            <form class="form-inline"  action="{{ route('trainees.show', 'id') }}" method="GET">
                {{ csrf_field() }}
                <div class="form-group mx-sm-3 mb-3">
                    <label for="epfNo" class="mr-5">EPF No:</label>
                    <input type="text" class="form-control" id="epfNo" name="epfNo" placeholder="" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Find</button>
            </form>
        </div>
    </div>

    @if(session('trainee'))
        <div class="card border-success">
            <div class="card-header">
                Results
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Experience</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{session('trainee')[0]['NameWithInitial']}}</th>
                        <td>{{session('trainee')[0]['designationName']}}</td>
                        <td>{{session('trainee')[0]['experience']}}</td>
                        <td>
                            <form action="{{ route('trainings.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="programId" value="{{$program[0]->programId}}">
                                <input type="hidden" name="userId" value="{{session('trainee')[0]['EmployeeId']}}">
                                <input type="hidden" name="type" value="LocalProgram">
                                <input type="submit" class="btn btn-primary" value="Add">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">{{$program[0]->title}}</h4>
        </div>
        <div class="card-body  p-4">
{{--            <img src="storage/7edfea74f45405fb147f478bd6b08d68.jpg{{str_replace("public", "storage", url($program[0]->brochureUrl))}}" alt="" class="img-thumbnail">--}}


            {{--            {"id":1,"programId":"d55edd46468bae657b1f5278b72cab3d","title":"Optio totam odio quo","organisedBy":"Voluptas autem architecto labore","targetGroup":"Amet eius nobis asperiores corrupti ullam quae ea et eveniet","startDate":"2021-02-11 12:52:55.000","endDate":"2021-07-06 12:37:35.000","applicationClosingDateTime":"2019-05-19 19:49:35.000","nonMemberFee":"1314.0","memberFee":"1397.0","studentFee":"1250.0","brochureUrl":"public\/brochures\/bd141fbc4195ca206c1fc474ad23410a.jpg","createdBy":"vonrueden.myra@example.net","updatedBy":null,"created_at":"2019-04-04 21:29:53.000","updated_at":"2019-04-04 21:29:53.000--}}
            <div class="row">
                <div class="col col-md-6 mb-3">
                    <img src="https://www.visme.co/wp-content/uploads/2018/12/technology-brochure-template-visme.jpg" alt="" class="img-thumbnail">
                </div>
                {{--                {{ucfirst(preg_replace('/(?<! )[A-Z]/', ' $0', 'helloWorld'))}}--}}
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

    <div class="card mb-5">
        <div class="card-header">
            Selected Trainees
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Experience</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($trainees as $trainee)
                        <tr>
                            <th scope="row">{{$trainee[0]['NameWithInitial']}}</th>
                            <td>{{$trainee[0]['DesignationId']}}</td>
                            <td>{{$trainee[0]['DateOfAppointment']}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
