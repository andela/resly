<!DOCTYPE html>
<html>
<head>
    <title>Resly &#187; @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
    @yield('styles')
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Resly</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        @yield('navbar')
        <ul class="nav navbar-nav navbar-right">
          @if (Auth::check())
            <div class = "btn-group flow-group">
              <button type="button" class="btn btn-default">
                {{ Auth::user()->fname }}
                {{ Auth::user()->name }}
              </button>
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle = "dropdown">
                <span class = "caret"></span>
              </button>
              <ul class="dropdown-menu" role = "menu">
                <li><a href="{{ route('profile.show', ['username' => Auth::user()->username]) }}">
                  <span class="glyphicon glyphicon-user"></span> Your Profile</a>
                </li>
                <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
                <li class="divider"></li>
                <li><a href="/auth/logout"><span class="glyphicon glyphicon-log-out"></span> Signout</a></li>
              </ul>
            </div>
          @else
            <li><a href="/auth/login" target="_self">Login</a></li>
            <li><a href="/auth/register" target="_self">Register</a></li>
          @endif
        </ul>
      </div><!--/.nav-collapse -->
    </div>
    </nav>

    @yield('content')

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
                  <div class="separator"></div>
                  <p class="text-center margin-clear">Copyright © 2015 Resly <a target="_blank" href="http://resly.me">Resly</a>. All Rights Reserved</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- .footer end -->
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>