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
                    <th style="width: 35%;">Name</th>
                    <th style="width: 20%;">Email</th>
                    <th style="width: 10%;">Created On</th>
                    <th style="width: 15%;">Role</th>
                    <th style="width: 15%;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                        {{-- Retrieve array of roles associated to a user and convert to string --}}
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

                </div>
            </div>
        </div>
    </div>
@endsection