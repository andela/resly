@extends('dashboard.login')

@section('title', 'login')
@section('styles')

    @parent
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato:400,100' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type="text/css" href="{!! asset('css/login.css') !!}"/>
    <link rel='stylesheet' type="text/css" href="{!! asset('css/bootstrap-social.css') !!}"/>
@endsection
@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Login </h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="">
                <div class='info'>
                    <h5>Follow your taste</h5>
                    <p>Get to reserve the table of your choice</p>
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
                    <span class='or-label'>OR</span>

                    <div class="social">
                        <a class="btn btn-block btn-social btn-twitter" href="{{ url('/auth/twitter') }}">
                            <span class="fa fa-twitter"></span> Sign in with Twitter
                        </a>
                        <a class="btn btn-block btn-social btn-facebook" href="{{ url('/auth/facebook') }}">
                            <span class="fa fa-facebook"></span> Sign in with Facebook
                        </a>
                        <a class="btn btn-block btn-social btn-google" href="{{ url('/auth/google') }}">
                            <span class="fa fa-google"></span> Sign in with Google
                        </a>
                    </div>
                </div>
            </div><!-- end of container -->
        </div>

        </div>
    </div>
@endsection
