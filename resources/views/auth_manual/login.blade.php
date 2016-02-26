@extends('layouts.master')

@section('title', 'login')
@section('styles')
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato:400,100' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type="text/css" href="{!! asset('css/login.css') !!}"/>
@endsection
@section('content')
    <div class="container">
        <div class="login">
            <div class='info'>
                <h5>Follow your taste</h5>
                <p>Get to reserve the restaurant of your choice</p>
            </div>
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