@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Create User</p>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('users')}}"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>&nbsp;Back</a>
        </div>
        <div class="panel-body">

            <div class='col-lg-4 col-lg-offset-4'>

                <h1><i class='fa fa-user-plus'></i> Edit {{$user->name}}</h1>
                <hr>

                {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', null, array('class' => 'form-control')) }}
                </div>

                <h5><b>Give Role</b></h5>

                <div class='form-group'>
                    @foreach ($roles as $role)
                        {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                        {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                    @endforeach
                </div>

                <div class="form-group">
                    {{ Form::label('password', 'Password') }}<br>
                    {{ Form::password('password', array('class' => 'form-control')) }}

                </div>

                <div class="form-group">
                    {{ Form::label('password', 'Confirm Password') }}<br>
                    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                </div>

                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}


            </div>

{{--            <div class="col-md-8 col-md-offset-2">--}}
{{--                <form action="{{ route('users.store') }}" method="post">--}}
{{--                    {!! csrf_field() !!}--}}

{{--                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">--}}
{{--                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"--}}
{{--                               placeholder="{{ trans('adminlte::adminlte.full_name') }}" required>--}}
{{--                        <span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
{{--                        @if ($errors->has('name'))--}}
{{--                            <span class="help-block">--}}
{{--                            <strong>{{ $errors->first('name') }}</strong>--}}
{{--                        </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">--}}
{{--                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"--}}
{{--                               placeholder="{{ trans('adminlte::adminlte.email') }}" required>--}}
{{--                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
{{--                        @if ($errors->has('email'))--}}
{{--                            <span class="help-block">--}}
{{--                            <strong>{{ $errors->first('email') }}</strong>--}}
{{--                        </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">--}}
{{--                        <input type="password" name="password" class="form-control"--}}
{{--                               placeholder="{{ trans('adminlte::adminlte.password') }}" required>--}}
{{--                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
{{--                        @if ($errors->has('password'))--}}
{{--                            <span class="help-block">--}}
{{--                            <strong>{{ $errors->first('password') }}</strong>--}}
{{--                        </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">--}}
{{--                        <input type="password" name="password_confirmation" class="form-control"--}}
{{--                               placeholder="{{ trans('adminlte::adminlte.retype_password') }}" required>--}}
{{--                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>--}}
{{--                        @if ($errors->has('password_confirmation'))--}}
{{--                            <span class="help-block">--}}
{{--                            <strong>{{ $errors->first('password_confirmation') }}</strong>--}}
{{--                        </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <button type="submit" class="btn btn-primary btn-flat pull-right">Create</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

        </div>
    </div>


    <script>
        window.onload = function () {

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/users/getUsers",
                order: [1, 'asc'],

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        }
    </script>
@endsection