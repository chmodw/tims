@extends('layouts.app')

@section('content')
    <div class="text-center login-container">
        <form action="{{ route('login') }}" class="form-signin" method="POST">
            {{ csrf_field() }}
{{--            <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">--}}
            <h1>TIMS</h1>
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">
                Email address
            </label>
            <input type="email" name="email" id="inputEmail" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Email address" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
            @endif
            <label for="inputPassword" class="sr-only">
                Password
            </label>
            <input type="password" name="password" id="inputPassword" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password" required>
            <div class="form-group">
                <div>
                    <label class="checkbox">
                        <input type="checkbox" data-toggle="checkbox"> Remember
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
            <a href="{{ route('register') }}" class="btn btn-lg btn-default btn-block">Register</a>
            <div class="text-right">
                <a href="{{ route('password.request') }}" class="text-muted">Forgot Password</a>
            </div>
        </form>
    </div>
@endsection
