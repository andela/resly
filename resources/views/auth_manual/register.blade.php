@extends('dashboard.registration')

@section('title', 'register')
@section('styles')
    @parent
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato:400,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
    <link rel='stylesheet' type="text/css" href="{!! asset('css/registration.css') !!}"/>
    <link rel='stylesheet' type="text/css" href="{!! asset('css/bootstrap-social.css') !!}"/>
@endsection
@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Registration form</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class="col col-md-8">
                    <form role="form" method="POST" action=" {{ route('register') }}">
                        @include('partials.error')

                        <div class="row">
                            <div class="col col-md-6 ">
                                <div class="form-group {{ $errors->has('fname') ? ' has-error' : '' }}">
                                    <label for="fname" class="control-label">First Name</label>
                                    <input type="text" name="fname" class="form-control" id="fname" value="{{ old('fname') ?: '' }}">
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group {{ $errors->has('lname') ? ' has-error' : '' }}">
                                    <label for="lname" class="control-label">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="lname" value="{{ old('lname') ?: '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">      
                            <label for="username" class="control-label">Username</label>      
                            <input type="text" name="username" class="form-control" id="username" value="{{ old('username') ?: '' }}">        
                         </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') ?: '' }}">
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group{{ $errors->has('confirm-password') ? ' has-error' : '' }}">
                                    <label for="confirm-password" class="control-label">Confirm Password</label>
                                    <input type="password" name="confirm-password" class="form-control" id="password">
                                </div>
                            </div>
                        </div>


                        <div class="form-horizontal">
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="control-label col-xs-3 col-md-5">Account Type</label>
                                <div class="col-xs-3 col-md-7">
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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>


                <div class='col col-md-4'>
                    <div class="social">
                        <span class='or'>OR </span>
                        <a href="{{ url('/auth/facebook') }}" class="btn btn-social btn-block btn-facebook">
                            <i class="fa fa-facebook"></i>
                            Sigup with Facebook
                        </a>


                        <a href="{{ url('/auth/twitter') }}" class="btn btn-social btn-block btn-twitter">
                            <i class="fa fa-twitter"></i>
                            Signup with Twitter
                        </a>

                        <a href="{{ url('/auth/google') }}" class="btn btn-social btn-block btn-google">
                            <i class="fa fa-google"></i>
                            Signup with Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
