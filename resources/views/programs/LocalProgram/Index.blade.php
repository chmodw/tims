@extends('home')


@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Local Programs
        </div>
        <div class="panel-body">
            <table class="table table-bordered" id="table">
                <thead>
                <tr>
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
                    { data: 'program_title', name: 'program_title' },
                    { data: 'target_group', name: 'target_group' },
                    { data: 'application_closing_date_time', name: 'application_closing_date_time' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'organised_by', name: 'organised_by' },
                    { data: 'venue', name: 'venue' },
                ]
            });
        }
    </script>
@endsection