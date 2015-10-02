<!DOCTYPE html>
<html>
<head>
    <title>Resly @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css">
    @yield('styles')
</head>
<body>

    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">

          @yield('navbar')

          <ul class="nav navbar-nav navbar-right">
            <li><a href="/diner" target="_blank">Diner</a></li>
            <li><a href="/restaur" target="_blank">Restauranteur</a></li>
          </ul>

        </div>
      </div>
    </div>


    @yield('content')

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>