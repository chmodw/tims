@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Add Permission</p>
            <a href="{{ route('permissions.index') }}" style="margin-right:8px;" class="btn btn-info pull-right"><i class="glyphicon glyphicon-user margin-right-sm"></i>Back</a>
            <a href="{{ route('roles.index') }}" style="margin-right:8px;" class="btn btn-info pull-right"><i class="glyphicon glyphicon-lock margin-right-sm"></i>Roles</a></h1>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('users')}}"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>&nbsp;Users</a>
        </div>
        <div class="panel-body">
            <div class='col-lg-4 col-lg-offset-4'>

                {{ Form::open(array('url' => 'permissions')) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', '', array('class' => 'form-control')) }}
                </div><br>
                @if(!$roles->isEmpty()) //If no roles exist yet
                <h4>Assign Permission to Roles</h4>

                @foreach ($roles as $role)
                    {{ Form::checkbox('roles[]',  $role->id ) }}
                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                @endforeach
                @endif
                <br>
                {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

            </div>
        </div>
    </div>

@endsection