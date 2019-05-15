@extends('home')

@section('main-content')

    @include('layouts._alert')

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
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="page-heading">
                    <h1>CECB - Training Information Management System</h1>
                </div>
            </div>
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