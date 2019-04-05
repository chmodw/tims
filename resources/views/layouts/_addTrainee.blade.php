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
                            <input type="hidden" name="type" value="{{$programType}}">
                            <input type="submit" class="btn btn-primary" value="Add">
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif