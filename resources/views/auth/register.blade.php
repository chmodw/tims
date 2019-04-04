@extends('layouts.app')

@section('main')
<div class="row">
  <div class="col-md-4 offset-md-4">
    <div class="auth-card card">
      <div class="card-header">
        <h4 class="card-title">Register</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('register') }}" method="POST">
          {{ csrf_field() }}
          <fieldset>
            <div class="form-group">
              <label for="name">Name</label>
              <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required>
              @if ($errors->has('name'))
              <span class="invalid-feedback">{{ $errors->first('name') }}</span>
              @endif
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" required>
              @if ($errors->has('email'))
              <span class="invalid-feedback">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required>
              @if ($errors->has('password'))
              <span class="invalid-feedback">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="form-group">
              <label for="password_confirmation">Password Confirmation</label>
              <input name="password_confirmation" type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" required>
              @if ($errors->has('password_confirmation'))
              <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
              @endif
            </div>
            <!-- Change this to a button or input when using this as a form -->
            <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
            <a href="{{ route('login') }}" class="btn btn-lg btn-default btn-block">Login</a>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
