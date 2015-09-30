@extends('partials.navigation')
@section('navigation')
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Resly</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::diner()->check()) 
              <li><a href="{{ route('dinersignout')}}">Signout</a></li>
            @else
              <li><a href="{{ route('dinersignin')}}">Login</a></li>
              <li><a href="{{ route('dinersignup')}}">Register</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
@stop
@section('content')
<div class="row">
    <div class="col-lg-6">
        <h3>Register</h3>
        <form class="form-vertical" role="form" method="post" action="{{ route('dinersignup') }}">
            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                <label for="fname" class="control-label">First Name</label>
                <input type="text" name="fname" class="form-control" id="lname" value="{{ Request::old('fname') ?: '' }}">
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
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ Request::old('email') ?: '' }}">
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
    </div>
</div>
@stop