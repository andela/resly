@extends('layouts.master')

@section('title', 'Dinner Sign In')

@section('styles')
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{!! asset('css/auth.css') !!}">
@endsection

@section('navbar')
   <div>
   	 <ul class="nav navbar-nav navbar-right">
       <li><a href="{{ route('dinersignup')}}">Register</a></li>
     </ul>
   </div>
@endsection

@section('content')
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
                <h3>OR</h3>
                <div class="row">
                    <div class="col-xs-8">
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