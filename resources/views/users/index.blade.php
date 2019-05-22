@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">User Manager</p>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{url('users/create')}}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{route('roles.index')}}"><i class="glyphicon glyphicon-lock margin-right-sm"></i>&nbsp;Roles</a>
        </div>
        <div class="panel-body">

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if(Gate::check('User-edit') || Gate::check('Change-username'))
                                <a class="btn btn-primary" href="{{ url('users/edit/'.$user->id.'/username') }}">Edit</a>
                            @endif
                            @if(Gate::check('User-edit') || Gate::check('Change-password'))
                                <a class="btn btn-info" href="{{url('users/edit/'.$user->id.'/password') }}">Change Password</a>
                            @endif
                            @can('User-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>

            @cannot('User-list')
                <span class="label label-info">You Don't haver permission to see other user information.</span>
            @endcannot
                </div>
            </div>
        </div>
    </div>


{{--    <script>--}}
{{--        window.onload = function () {--}}

{{--            $('#table').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: "/users/getUsers",--}}
{{--                order: [1, 'asc'],--}}

{{--                columns: [--}}
{{--                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},--}}
{{--                    {data: 'name', name: 'name'},--}}
{{--                    {data: 'email', name: 'email'},--}}
{{--                    {data: 'created_at', name: 'created_at'},--}}
{{--                ]--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
@endsection