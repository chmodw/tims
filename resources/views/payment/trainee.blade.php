@extends('home')


@section('main-content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Add Trainee
        </div>
        <div class="panel-body">
            <form class="form-inline"  action="{{ route('payment.show', 'id') }}" method="GET">
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
        <div class="panel panel-default">
            <div class="panel-heading">
                Results
            </div>
            <div class="panel-body">
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
                            <th scope="row">{{session('trainee')[0]['Full Name']}}</th>
                            <td>{{session('trainee')[0][' Trainee ID']}}</td>
                            <td>{{session('trainee')[0]['Program ID']}}</td>
                            <td>
                                <form action="{{route('programs.trainees')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="programId" value="{{$program_id}}">
                                    <input type="hidden" name="userId" value="{{session('trainee')[0]['EmployeeId']}}">
                                    <input type="hidden" name="type" value="{{$program_type}}">
                                    <div class="input-group">
                                        <select class="form-control" name="recommendation">
                                            <option value="AGM">AGM</option>
                                            <option value="AGM(D1)">AGM(D1)</option>
                                            <option value="AGM(DHQC)">AGM(DHQC)</option>
                                            <option value="AGM(SP-2)">AGM(SP-2)</option>
                                            <option value="AGM(Central)">AGM(Central)</option>
                                        </select>
                                        <span class="input-group-btn">
                                             <input type="submit" class="btn btn-default" value="Select">
                                        </span>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            Selected Trainees
        </div>
        <div class="panel-body">
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
                        <td>{{date('Y-m-d',strtotime($trainee[0]['DateOfAppointment']))}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>

    </script>
@endsection