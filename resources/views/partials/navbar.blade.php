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
    <ul class="nav navbar-nav navbar-right">
        @can('authenticated')
            <div class = "btn-group">
                <button type="button" class="btn btn-default nav-btn">
                    {{ auth()->user()->username }}
                </button>
                <button type="button" class="btn btn-default dropdown-toggle nav-btn" data-toggle = "dropdown">
                    <span class = "caret"></span>
                </button>
                <ul class="dropdown-menu nav-ul" role = "menu">
                    <li><a href="{{ route('userProfile', ['username' => auth()->user()->username]) }}">
                      <span class="glyphicon glyphicon-user"></span> Your Profile</a>
                    </li>
                    <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout')}}"><span class="glyphicon glyphicon-log-out"></span> Signout</a></li>
                </ul>
            </div>
        @else
            <li><a href="{{ route('login') }}" target="_self">Login</a></li>
            <li><a href="{{ route('register') }}" target="_self">Register</a></li>
        @endcan
    </ul>
  </div><!--/.nav-collapse -->
</div>
</nav>