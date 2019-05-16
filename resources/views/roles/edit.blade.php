@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Create New Role</p>
            <a href="{{ route('permissions.index') }}" style="margin-right:8px;" class="btn btn-info pull-right"><i class="glyphicon glyphicon-user margin-right-sm"></i>Users</a>
            <a href="{{ route('roles.create') }}" style="margin-right:8px;" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus margin-right-sm"></i>Add Role</a>
            <a href="{{ route('permissions.index') }}"  style="margin-right:8px;"  class="btn btn-default pull-right"><i class="glyphicon glyphicon-user margin-right-lock"></i>Permissions</a>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('users')}}"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>&nbsp;Back</a>
        </div>
        <div class="panel-body">

            <div class='col-lg-4 col-lg-offset-4'>

                {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

                <div class="form-group">
                    {{ Form::label('name', 'Role Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>

                <h5><b>Assign Permissions</b></h5>
                @foreach ($permissions as $permission)

                    {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                    {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

                @endforeach
                <br>
                {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

            </div>

        </div>
    </div>

@endsection