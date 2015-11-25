@extends('layouts.master')

@section('title', 'register')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
@endsection

@section('content')
  <div class="register">
      <div class="container">
            <form role="form" method="POST" action="/auth/register">
                @if (count($errors) > 0)
                    <div class="alert alert-success">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                <div class="form-group">
                    <label for="fname" class="control-label">First Name</label>
                    <input type="text" name="fname" class="form-control" id="fname" value="{{ Request::old('fname') ?: '' }}">
                </div>
                <div class="form-group">
                    <label for="lname" class="control-label">Last Name</label>
                    <input type="text" name="lname" class="form-control" id="lname" value="{{ Request::old('lname') ?: '' }}">
                </div>
                <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" value="{{ Request::old('username') ?: '' }}">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ Request::old('email') ?: '' }}">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="confirm-password" class="control-label">Confirm Password</label>
                    <input type="password" name="confirm-password" class="form-control" id="password">
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="role" class="control-label col-xs-2">Diner or Restaurateur</label>
                        <div class="col-xs-3">
                            <select name = "role" class="form-control select">
                              <option value = "">Select user type</option>
                              <option value = "diner">Diner</option>
                              <option value = "restaurateur">Restaurateur</option>
                            </select>
                        </div>
                    </div>
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
      </div><!-- end of container -->
  </div>
@endsection