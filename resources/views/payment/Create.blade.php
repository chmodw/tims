@extends('home')


@section('main-content')

<div class="panel panel-default">
    <div class="panel-heading">
       Payments
    </div>
    <div class="panel-body">
        <form method="POST" action="{!! url('payment') !!}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="trainee_name" name="trainee_name">
            <div class="col-md-10">
                <div class="form-group has-feedback {{$errors->has('trainee_name') ? 'has-error' : ''}}">
                    <label for="trainee_name">Employee Name</label>
                    <select class="form-control" id="trainee_name" name="trainee_name">
                        <option selected>Choose...</option>
                        @foreach($programs as $program)
                            <option value="{{$program->trainees->EmployeeId}}">{{$program->trainees->NameWithInitial}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2 pull-right" value="reload_page">Save</button>
                <button type="submit" name="_submit" class="btn btn-primary mb-2 pull-right" style="margin-right: 15px;" value="redirect">Save &amp; Go Back</button>
            </div>

            <div class="col-md-12">

                <table id="AssignedProjectTable" class="table table-responsive table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Program ID</th>
                            <th>Program Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody id="AssignedProjectTableBody"></tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')

    <script type="application/javascript">

        'use strict'

        var traineeeNameSelector = $( "#trainee_name" );

        $(function() {

            fetchAssignedProgrames();

          traineeeNameSelector.click(function() {

                if(validateTraineeNameisEmpty){
                    fetchAssignedProgrames();
                }else {
                    alert('Trainee name cannot be empty...');
                }

            });

            traineeeNameSelector.change(function() {
                if(validateTraineeNameisEmpty){
                    fetchAssignedProgrames();
                }else {
                    alert('Trainee name cannot be empty...');
                }
            });

        });

        function validateTraineeNameisEmpty()
        {

            var traineeName = traineeeNameSelector.val();
            if(traineeName === 'undefine' || traineeName === null || traineeName ===''){
                return false;
            }
            return true;

        }

        function fetchAssignedProgrames()
        {


            var url = '{!! url('api/user') !!}/'+traineeeNameSelector.val()+'/assigned-programs';
            $('.removeRW').remove();
            $.ajax({
                url: url,
                success: filler,
                statusCode: {
                    404: function() {
                        alert( "Error Request" );
                    }
                }
            });

        }

        function filler(data) {
            var count =0 ;
            data.forEach(function (item) {
               addRow(item,count);
               count++;
            });
        }

        function addRow(data,count) {
            $('#AssignedProjectTableBody')
                .append(
                    '<tr class="removeRW">' +
                        '<td>'+data.info.program_id+'</td>'+
                        '<td>'+data.info.program_title+'</td>'+
                        '<td>' +
                    '<input type="number" name="row['+count+'][amount]"> ' +
                    '<input style="display: none" type="text" name="row['+count+'][program_id]" readonly value="'+data.info.program_id+'"> ' +
                    '<input style="display: none" type="text" name="row['+count+'][program_title]" readonly value="'+data.info.program_title+'">' +
                    '</td>'+
                    '</tr>');
        }

    </script>

@endsection