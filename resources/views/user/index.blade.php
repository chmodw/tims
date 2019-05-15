@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">User Manager</p>
            <a class="btn btn-danger pull-right" style="margin-right:8px;" href="{{url('users/edit')}}"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete Current Account</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{url('users/edit')}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit Password</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{url('users/create')}}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">

            <table class="table table-striped table-bordered" id="table">
                <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 37%;">Name</th>
                    <th style="width: 18%;">Email</th>
                    <th style="width: 15%;">Created On</th>
{{--                    <th style="width: 15%;">Created By</th>--}}
                </tr>
                </thead>
            </table>

                </div>
            </div>
        </div>
    </div>


    <script>
        window.onload = function () {

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/users/getUsers",
                order: [1, 'asc'],

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        }
    </script>
@endsection