@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="pull-left">Employee View</p>
            <div class="btn-container">
                <a href="{{route('local.index')}}" class="btn btn-default pull-right margin-right-sm"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
            </div>
        </div>
        <div class="panel-body">

            <div class="col-md-10 col-md-offset-1">

                <table class="table table-bordered table-striped">
                    <thead>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                        <th style="width: 12.5%"></th>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="1">Title</th>
                        <td colspan="1">{{$employee->Title}}</td>
                        <th colspan="1">Full Name</th>
                        <td colspan="5">{{$employee->FullName}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Initials</th>
                        <td colspan="2">{{$employee->Initial}}</td>
                        <th colspan="2">Name With Initials</th>
                        <td colspan="3">{{$employee->NameWithInitial}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Date Of Birth</th>
                        <td colspan="2">{{date("Y-m-d", strtotime($employee->DateOfBirth))}}</td>
                        <th colspan="1">Blood Group</th>
                        <td colspan="1">{{$employee->BloodGroup}}</td>
                        <th colspan="1">Civil Status</th>
                        <td colspan="1">{{$employee->CivilStatus}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Home Address</th>
                        <td colspan="6">{{$employee->HomeAddress}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Contact Address</th>
                        <td colspan="6">{{$employee->ContactAddress}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Telephone</th>
                        <td colspan="3">{{$employee->LandphoneNumber}}</td>
                        <th colspan="1">Mobile</th>
                        <td colspan="3">{{$employee->MobileNumber}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Private Email</th>
                        <td colspan="6">{{$employee->PrivateEmail}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Office Email</th>
                        <td colspan="3">{{$employee->OfficeEmail}}</td>
                        <th colspan="1">Office Email 2</th>
                        <td colspan="3">{{$employee->OfficeEmail2}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">EPF No</th>
                        <td colspan="2">{{$employee->EPFNo}}</td>
                        <th colspan="1">Employee Code</th>
                        <td colspan="4">{{$employee->EmployeeCode}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Recruitment Type</th>
                        <td colspan="1">{{$employee->EmployeeRecruitmentType}}</td>
                        <th colspan="1">Date Of Appointment</th>
                        <td colspan="2">{{date("Y-m-d", strtotime($employee->DateOfAppointment))}}</td>
                        <th colspan="1">Contract Type</th>
                        <td colspan="2">{{$employee->TypeOfContract}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Initial Basic Salary</th>
                        <td colspan="1">{{$employee->InitialBasicSalary}}</td>
                        <th colspan="2">BasicSalary</th>
                        <td colspan="3">{{$employee->BasicSalary}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Grade</th>
                        <td colspan="2">{{$employee->GradeName}}</td>
                        <th colspan="1">Designation</th>
                        <td colspan="4">{{$employee->DesignationName}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Work Space</th>
                        <td colspan="2">{{$employee->WorkSpaceName}}</td>
                        <th colspan="1">Work Space Code</th>
                        <td colspan="1">{{$employee->WorkSpaceCode}}</td>
                        <th colspan="1">Type</th>
                        <td colspan="2">{{$employee->WorkSpaceTypeName}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Work Space Location</th>
                        <td colspan="6">{{$employee->LocationName}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Personal File No</th>
                        <td colspan="6">{{$employee->PersonalFileNo}}</td>
                    </tr>
                    </tbody>
                </table>

                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        Program History
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped" style="width: 100%;" id="programs_table">
                            <thead>
                            <tr>
                                <th style="min-width:5%;">#</th>
                                <th style="width:55%;">Program Title</th>
                                <th style="width:25%;">Program Type</th>
                                <th style="width:15%;">Start Date</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        window.onload = function () {
            $('#programs_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/program/{{$employee->EPFNo}}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'program_title', name: 'program_title', orderable: true, searchable: true},
                    {data: 'program_type', name: 'program_type', orderable: true, searchable: true},
                    {data: 'start_date', name: 'start_date', orderable: true, searchable: true},
                    // {data: 'program_title', name: 'program_title', orderable: true, searchable: true},
                    // {data: 'target_group', name: 'target_group'},
                    // {data: 'application_closing_date_time', name: 'application_closing_date_time'},
                    // {data: 'start_date', name: 'start_date'},
                    // {data: 'name', name: 'name'},
                    // {data: 'venue', name: 'venue'},
                    // {data: 'created_at', name: 'created_at'},
                ]
            });
        }
    </script>
@endsection