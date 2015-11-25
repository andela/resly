@extends('layouts.master')

@section('title', 'register')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
@endsection

@section('content')
  <div class="register">
      <div class="container">
            <h2>Register</h2>
            <hr />
          <form class="form-vertical" role="form" method="POST" action="{{ route('postSocialRegister') }}">
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
            <div class="radio">
              <label>
                <input type="radio" name="role" id="roleRadios1" value="diner" checked>
                Sign up as a Diner
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="role" id="roleRadios2" value="restaurateur">
                Sign up as a Restaurateur
              </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sign up</button>
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
          </form>
          
      </div><!-- end of container -->
  </div>
@endsection