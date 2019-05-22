@extends('home')

@section('main-content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Edit {{$user->name}}</p>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('users')}}"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>&nbsp;Back</a>
        </div>
        <div class="panel-body">

            <div class="col-md-8 col-md-offset-2">

                @include('layouts._alert')

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="row">
                    @if($editwhat == 'username')
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                            <strong>Email:</strong>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'readonly')) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                        @if($editwhat == 'password')
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group {{$errors->has('current-password') ? 'has-error' : ''}}">
                                    <strong>Current Password:</strong>
                                    {!! Form::password('current-password', array('placeholder' => 'Current Password','class' => 'form-control')) !!}
                                    @if ($errors->has('current-password'))
                                        <span class="help-block">{{ $errors->first('current-password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                    <strong>Password:</strong>
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group {{$errors->has('confirm-password') ? 'has-error' : ''}}">
                                    <strong>Confirm Password:</strong>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                    @if ($errors->has('confirm-password'))
                                        <span class="help-block">{{ $errors->first('confirm-password') }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($editwhat == 'username')
                            @can('User-edit')
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group {{$errors->has('roles') ? 'has-error' : ''}}">
                                    <strong>Role:</strong>
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                                    @if ($errors->has('roles'))
                                        <span class="help-block">{{ $errors->first('roles') }}</span>
                                    @endif
                                </div>
                            </div>
                            @endcan
                        @endif
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>
    
@endsection