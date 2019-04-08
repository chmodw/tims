@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Register an Account</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required="required">
                            <label for="name">{{ __('Name') }}</label>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" required="required">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                                    <label for="inputPassword">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                                    <label for="confirmPassword">Confirm password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
