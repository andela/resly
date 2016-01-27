<!DOCTYPE html>
<html>
<head>
    <title>Resly &#187; @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('wickedpicker/wickedpicker.min.css') !!}">
    
    <script type="text/javascript" src ="{!! asset('wickedpicker/wickedpicker.min.js') !!}"></script>
    @yield('styles')
</head>
<body>

    @include('partials.navbar')

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