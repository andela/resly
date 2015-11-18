@extends('layouts.master')

@section('title', 'Resly | A one stop shop for your reservation needs')

@section('styles')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">
<link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('css/navbar-fixed-top.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('css/auth.css') !!}">
@endsection

@section('navbar')
  @include ('partials.navbar');
@endsection


@section('content')
  @include ('partials.alerts');
  @if (! Auth::diner()->check())
  <div class="container">
      
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active">
          <a href="#Register" role="tab" data-toggle="tab">Register</a>
      </li>
      <li>
        <a href="#Login" role="tab" data-toggle="tab">Login</a>
      </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" id="Register">
          
        <div class="container">
          <div class="col-lg-6 white">
              <h3>Register</h3>
              <form class="form-vertical" role="form" method="post" action="{{ route('dinersignup') }}">
                  <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                      <label for="fname" class="control-label">First Name</label>
                      <input type="text" name="fname" class="form-control" id="fname" value="{{ Request::old('fname') ?: '' }}">
                      @if ($errors->has('fname'))
                          <span class="help-block">{{ $errors->first('fname') }}</span>
                      @endif
                  </div>
                  <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                      <label for="lname" class="control-label">Last Name</label>
                      <input type="text" name="lname" class="form-control" id="lname" value="{{ Request::old('lname') ?: '' }}">
                      @if ($errors->has('lname'))
                          <span class="help-block">{{ $errors->first('lname') }}</span>
                      @endif
                  </div>
                  <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                      <label for="username" class="control-label">Username</label>
                      <input type="text" name="username" class="form-control" id="username" value="{{ Request::old('username') ?: '' }}">
                      @if ($errors->has('username'))
                          <span class="help-block">{{ $errors->first('username') }}</span>
                      @endif
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="control-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" value="{{ Request::old('email') ?: '' }}">
                      @if ($errors->has('email'))
                          <span class="help-block">{{ $errors->first('email') }}</span>
                      @endif
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="control-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password">
                      @if ($errors->has('password'))
                          <span class="help-block">{{ $errors->first('password') }}</span>
                      @endif
                  </div>
                  <div class="form-group{{ $errors->has('confirm-password') ? ' has-error' : '' }}">
                      <label for="password" class="control-label">Confirm Password</label>
                      <input type="password" name="confirm-password" class="form-control" id="password">
                      @if ($errors->has('confirm-password'))
                          <span class="help-block">{{ $errors->first('confirm-password') }}</span>
                      @endif
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Sign up</button>
                  </div>
                  <input type="hidden" name="_token" value="{{ Session::token() }}">
              </form>
              <div class="or">
                  <h2><span>OR</span></h2>
                  <div class="social">
                      <ul>
                          <li><a href="{{ url('auth/facebook') }}"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="{{ url('auth/twitter') }}"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="{{ url('auth/google') }}"><i class="fa fa-google-plus"></i> </a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
    </div>
      <div class="tab-pane fade" id="Login">
          <div class="container">
            <div class="col-lg-6 white">
              <h3>Login</h3>
              <form class="form-vertical" role="form" method="post" action="{{ route('dinersignin')}}">
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="control-label">Email</label>
                      <input type="text" name="email" class="form-control" id="email">
                      @if ($errors->has('email'))
                          <span class="help-block">{{ $errors->first('email') }}</span>
                      @endif
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="control-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password">
                      @if ($errors->has('password'))
                          <span class="help-block">{{ $errors->first('password') }}</span>
                      @endif
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="remember"> Remember me
                      </label>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Sign in</button>
                  </div>
                  <input type="hidden" name="_token" value="{{ Session::token() }}">
              </form>
              <div class="or">
                  <h2><span>OR</span></h2>
                  <div class="social">
                      <ul>
                          <li><a href="{{ url('auth/facebook') }}"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="{{ url('auth/twitter') }}"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="{{ url('auth/google') }}"><i class="fa fa-google-plus"></i> </a></li>
                      </ul>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@else
@endif
@endsection