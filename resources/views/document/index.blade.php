@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Document Manager</p>
{{--            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{url('templatemanager/create')}}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>--}}
        </div>
        <div class="panel-body">

            <table class="table table-bordered table-striped" style="width: 100%;" id="table">
                <thead>
                    <tr>
                        <th style="min-width:5%;">#</th>
                        <th style="width:30%;">Program Title</th>
                        <th style="width:15%;">Type</th>
                        <th style="width:30%;">File Name</th>
                        <th style="width:15%;">Created On</th>
                        <th style="width:5%;">Actions</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

    <script>
        window.onload = function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/document/get",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'program_title', name: 'program_title'},
                    {data: 'program_type', name: 'program_type'},
                    {data: 'file_name', name: 'file_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        }
    </script>
@endsection