@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">TIMS Login</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input type="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" required="required" autofocus="autofocus">
                            @if ($errors->has('email'))--}}
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label for="inputPassword">{{ __('Password') }}</label>
                            <input type="password" id="inputPassword" class="form-control " placeholder="Password" required="required">
                            @if ($errors->has('inputPassword'))--}}
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('inputPassword') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </form>
                <div class="text-center">
                    @if (Route::has('password.request'))
                        <a class="d-block small" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                            <a class="d-block small mt-3" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
