@extends('layouts.master')

@section('title', 'login')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
@endsection;

@section('navbar')
  @include('partials.navbar')
@endsection

@section('content')
    <div class="login">
        <div class="container">
          @include ('partials.alerts')
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_a" data-toggle="tab">Diner</a></li>
              <li><a href="#tab_b" data-toggle="tab">Restaurateur</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane rest-reg active col-lg-6" id="tab_a">
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
                <div class="tab-pane rest-reg rest-footer col-lg-6" id="tab_b">
                    <form class="form-vertical" role="form" method="post" action="{{ route('restsignin')}}">
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
                </div>
            </div><!-- tab content -->
        </div><!-- end of container -->
    </div>
@endsection