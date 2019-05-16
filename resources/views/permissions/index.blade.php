@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Available Permissions</p>
            <a href="{{ route('permissions.index') }}" style="margin-right:8px;" class="btn btn-info pull-right"><i class="glyphicon glyphicon-user margin-right-sm"></i>Users</a>
            <a href="{{ route('roles.index') }}" style="margin-right:8px;" class="btn btn-info pull-right"><i class="glyphicon glyphicon-lock margin-right-sm"></i>Roles</a></h1>
            <a href="{{ url('permissions/create') }}" style="margin-right:8px;" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus margin-right-sm"></i>Add Permission</a>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('users')}}"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>&nbsp;Back</a>
        </div>
        <div class="panel-body">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>Permissions</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
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