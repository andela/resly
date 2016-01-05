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

    @include('partials.navbar')

    @yield('content')

    <footer>
      <div class="footer">
        <div class="container">
          <div class="footer-inner">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="footer-content text-center padding-ver-clear">
                  <p><a target="_blank" href="/">Resly</a> | Home for your reservation needs.</p>
                  <div class="separator"></div>
                  <p class="text-center margin-clear">Copyright © 2015. All Rights Reserved</p>
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
