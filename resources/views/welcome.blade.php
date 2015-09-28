<!DOCTYPE html>
<html>
<head>
    <title>Resly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
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

          <ul class="nav navbar-nav navbar-right">
            <li><a href="/diner" target="_blank">Diner</a></li>
            <li><a href="/restaur" target="_blank">Restauranteur</a></li>
          </ul>

        </div>
      </div>
    </div>


    <div class="container">

      <div id="banner">
        <div class="inner">
            <h1>Welcome to resly <small>the new way to dine</small></h1>
        </div>
      </div>
    </div>

    <div id="content">
            <div class="container">
                <div class="row">
                  <div class="col-xs-6 col-md-3">
                    <div class="cell">
                        <a href="#" class="thumbnail">
                          <img src="/img/search.jpg" alt="...">
                        </a>
                    </div>
                    
                  </div>
                  <div class="col-xs-6 col-md-3">
                    <div class="cell">
                        <a href="#" class="thumbnail">
                          <img src="/img/reservation.jpg" alt="...">
                        </a>
                    </div>
                    
                  </div>
                  <div class="col-xs-6 col-md-3">
                    <div class="cell">
                       <a href="#" class="thumbnail">
                         <img src="/img/menu.jpg" alt="...">
                       </a> 
                    </div>
                    
                  </div>
                  <div class="col-xs-6 col-md-3">
                    <div class="cell">
                        <a href="#" class="thumbnail">
                          <img src="/img/wine.jpg" alt="...">
                        </a>
                    </div>
                    
                  </div>
                </div>
            </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>