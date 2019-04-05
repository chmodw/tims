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