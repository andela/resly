@extends('layouts.master')

@section('title', 'login')

@section('content')
    <div class="login">
        <div class="container">
          <form "form-vertical" role="form" method="post" action="{{ route('login') }}">
           @include('partials.error')
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="control-label">Email</label>
              <input type="text" name="email" class="form-control" id="email">
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="control-label">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember"> Remember me
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </form>

          <div class="or">
              <h2><span>OR</span></h2>
              <div class="social">
                <ul>
                  <li><a href="{{ url('/auth/facebook') }}"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="{{ url('/auth/twitter') }}"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="{{ url('/auth/google') }}"><i class="fa fa-google-plus"></i> </a></li>
                </ul>
              </div>
          </div>
        </div><!-- end of container -->
    </div>
@endsection