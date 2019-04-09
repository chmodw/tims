@extends('home')


@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h2 class="">Local Programs</h2>
            <a class="btn btn-default pull-right" href="/programs/create/LocalProgram"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped" style="width: 100%;" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Target Group</th>
                    <th>Application CLosing Date</th>
                    <th>Start Date</th>
                    <th>Organised By</th>
                    <th>Venue</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        window.onload = function()
        {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('programs/get/LocalProgram') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'program_title', name: 'program_title' },
                    { data: 'target_group', name: 'target_group' },
                    { data: 'application_closing_date_time', name: 'application_closing_date_time' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'organised_by', name: 'organised_by' },
                    { data: 'venue', name: 'venue' },
                    { data: 'action', name: 'action'},
                ]
            });
        }
    </script>
@endsection