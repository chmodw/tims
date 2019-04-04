@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-4 offset-md-4">
    <div class="auth-card card">
      <div class="card-header">
        <h4 class="card-title">Login</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('login') }}" method="POST">
          {{ csrf_field() }}
            <div class="form-group">
              <label for="email">Email address</label>
              <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" required>
              @if ($errors->has('email'))
              <span class="invalid-feedback">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" required>
              @if ($errors->has('password'))
              <span class="invalid-feedback">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="form-group">
              <div>
                <label class="checkbox">
                  <input type="checkbox" data-toggle="checkbox"> Remember
                </label>
              </div>
            </div>
            <!-- Change this to a button or input when using this as a form -->
            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
            <a href="{{ route('register') }}" class="btn btn-lg btn-default btn-block">Register</a>
            <div class="text-right">
              <a href="{{ route('password.request') }}" class="text-muted">Forgot Password</a>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
