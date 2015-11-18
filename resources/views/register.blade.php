@extends('layouts.master')

@section('title', 'register')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
@endsection

@section('navbar')
  @include('partials.navbar')
@endsection

@section('content')
  <div class="register">
      <div class="container">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_a" data-toggle="tab">Diner</a></li>
            <li><a href="#tab_b" data-toggle="tab">Restaurateur</a></li>
          </ul>
          <div class="tab-content">
              <div class="tab-pane active rest-reg col-lg-6" id="tab_a">
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
              <div class="tab-pane rest-reg col-lg-6" id="tab_b">
                  <form class="form-vertical" role="form" method="post" action="{{ route('restsignup') }}">
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
          </div><!-- tab content -->
      </div><!-- end of container -->
  </div>
  <div class="footer">
    <footer>
      <div class="footer">
        <div class="container">
          <div class="footer-inner">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="footer-content text-center padding-ver-clear">
                  <p>Resly | Home for your reservation needs.</p>
                  <ul class="list-inline mb-20">
                    <li><i class="text-default fa fa-map-marker pr-5"></i>One infinity loop, 54100</li>
                    <li><a href="tel:+00 1234567890" class="link-dark"><i class="text-default fa fa-phone pl-10 pr-5"></i>+00 1234567890</a></li>
                    <li><a href="mailto:info@theproject.com" class="link-dark"><i class="text-default fa fa-envelope-o pl-10 pr-5"></i>info@resly.com</a></li>
                  </ul>
                  <ul class="social-links circle animated-effect-1 margin-clear">
                    <div class="social">
                      <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i> </a></li>
                      </ul>
                    </div>
                  </ul>
                  <div class="separator">
                    <p class="text-center margin-clear">Copyright © 2015 <a target="_blank" href="http://resly.me">Resly</a>. All Rights Reserved</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- .footer end -->
    </footer>
  </div>
@endsection