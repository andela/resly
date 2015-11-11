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
      @if (Auth::restaurateur()->check()) 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::restaurateur()->get()->fname }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/profile">Your Profile</a></li>
            <li><a href="{{ route('restsignout')}}">Signout</a></li>
          </ul>
        </li>
      @elseif (Auth::diner()->check())
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::diner()->get()->fname }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/profile">Your Profile</a></li>
            <li><a href="{{ route('dinersignout')}}">Signout</a></li>
          </ul>
        </li>
      @else
        <li><a href="/login" target="_self">Login</a></li>
        <li><a href="/register" target="_self">Register</a></li>
      @endif
    </ul>
  </div><!--/.nav-collapse -->
</div>
</nav>