@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Roles</p>
            <a href="{{ route('permissions.index') }}" style="margin-right:8px;" class="btn btn-info pull-right"><i class="glyphicon glyphicon-user margin-right-sm"></i>Users</a>
            <a href="{{ route('roles.create') }}" style="margin-right:8px;" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus margin-right-sm"></i>Add Role</a>
            <a href="{{ route('permissions.index') }}"  style="margin-right:8px;"  class="btn btn-default pull-right"><i class="glyphicon glyphicon-user margin-right-lock"></i>Permissions</a>
        </div>
        <div class="panel-body">
            <div class="col-lg-10 col-lg-offset-1">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Operation</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($roles as $role)
                            <tr>

                                <td>{{ $role->name }}</td>

                                <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                                <td>
                                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
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