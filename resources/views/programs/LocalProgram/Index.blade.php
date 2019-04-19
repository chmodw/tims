@extends('home')


@section('main-content')

{{--    <ol class="breadcrumb">--}}
{{--        <li><a href="#">Programs</a></li>--}}
{{--        <li><a href="#">Local Programs</a></li>--}}
{{--    </ol>--}}

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            Local Programs
            <a class="btn btn-default pull-right" href="{{url('programs.create.LocalProgram')}}"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" style="width: 100%;" id="table">
                <thead>
                <tr>
                    <th style="min-width:5%;">#</th>
                    <th style="width:20%;">Title</th>
                    <th style="width:20%;">Target Group</th>
                    <th style="width:10%;">Cosing Date</th>
                    <th style="width:10%;">Start Date</th>
                    <th style="width:15%;">Organised By</th>
                    <th style="width:10%;">Venue</th>
                    <th style="width:10%;">Created on</th>
                    {{--                    <th style="width: 10%;">Actions</th>--}}
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
                ajax: '/api/programs/get/LocalProgram',
                order: [ 7, 'desc' ],

                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'program_title', name: 'program_title', orderable: true, searchable: true},
                    { data: 'target_group', name: 'target_group' },
                    { data: 'application_closing_date_time', name: 'application_closing_date_time' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'organised_by', name: 'organised_by' },
                    { data: 'venue', name: 'venue' },
                    { data: 'created_at', name: 'created_at' },
                    // { data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        }
    </script>
@endsection