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
                    </tr
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
                        <td colspan="2">{{$employee->BasicSalary}}</td>
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
            </div>
        </div>
    </div>

{{--    <div class="panel panel-default">--}}
{{--        <div class="panel-heading clearfix">--}}
{{--            Documents--}}
{{--        </div>--}}
{{--        <div class="panel-body">--}}
{{--            <a class="btn btn-primary" style="margin-right:8px;" href="/pdf/LocalProgram/{{$program->program_id}}">Approval Letter</a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script>

    </script>
@endsection