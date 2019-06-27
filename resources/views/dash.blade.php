@extends('home')

@section('main-content')

    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.css')}}">

    @include('layouts._alert')

    <div class="col-md-4">
        <div class="panel-heading clearfix">
            <p>Program Calender</p>
        </div>
        <div class="panel panel-default">

        </div>
    </div>
    <div class="col-md-8">
        <div class="panel-heading clearfix">
            <p>Tasks</p>
        </div>
        <div class="panel panel-default">

        </div>
    </div>
    <div class="col-md-8">
        <div class="panel-heading clearfix">
            <p>Recent Programs</p>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 37%;">Title</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel-heading clearfix">
            <p>Messages</p>
        </div>
        <div class="panel panel-default">

        </div>
    </div>
    <script>
        window.onload = function () {

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/program/get",
                order: [1, 'asc'],

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'program_title', name: 'program_title'},
                ]
            });
        }
    </script>


@endsection