@extends('home')

@section('content_header')
    <h1>CECB Employees</h1>
@stop

@section('main-content')

    @include('layouts._alert')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <a class="btn btn-default pull-right" href="{{route('local.create')}}">
                <i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped employee-table" style="" id="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Full Name</th>
                        <th>EPF</th>
                        <th>Employment</th>
                        <th>Experience</th>
                        <th>Recruitment Type</th>
                        <th>NIC</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Private Email</th>
                        <th>Office Email</th>
                        <th>Telephone</th>
                        <th>Mobile</th>
                        <th>Workspace</th>
                        <th>Designation</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/employee/get",
                order: [3, 'asc'],

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'Title', name: 'Title'},
                    {data: 'FullName', name: 'FullName'},
                    {data: 'EPFNo', name: 'EPFNo'},
                    {data: 'DateOfAppointment', name: 'DateOfAppointment'},
                    {data: 'Experience', name: 'Experience'},
                    {data: 'EmployeeRecruitmentType', name: 'EmployeeRecruitmentType'},
                    {data: 'NIC', name: 'NIC'},
                    {data: 'Gender', name: 'Gender'},
                    {data: 'DateOfBirth', name: 'DateOfBirth'},
                    {data: 'PrivateEmail', name: 'PrivateEmail'},
                    {data: 'OfficeEmail', name: 'OfficeEmail'},
                    {data: 'LandphoneNumber', name: 'LandphoneNumber'},
                    {data: 'MobileNumber', name: 'MobileNumber'},
                    {data: 'WorkSpaceTypeName', name: 'WorkSpaceTypeName'},
                    {data: 'DesignationName', name: 'DesignationName'},

                ]
            });
        }
    </script>
@stop