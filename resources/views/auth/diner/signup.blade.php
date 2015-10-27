@extends('layouts.master')

@section('title', 'Dinner Sign Up')

@section('styles')
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{!! asset('css/auth.css') !!}">
@endsection

@section('navbar')
   <div>
     <ul class="nav navbar-nav navbar-right">
       <li><a href="{{ route('dinersignin')}}">Login</a></li>
     </ul>
   </div>
@endsection

@section('content')
<div class="container">
    <div class="col-lg-6 white">
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
        <div class="or">
            <h3>OR</h3>
            <div class="row">
                <div class="col-xs-6">
                    <div class="btn-group">
                        <a class='btn btn-danger disabled'><i class="fa fa-google-plus"></i></a>
                        <a class='btn btn-danger' href="{{ url('auth/google') }}" > Sign in with Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop