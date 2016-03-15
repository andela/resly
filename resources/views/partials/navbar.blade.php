<nav class="navbar navbar-static-top navbar-resly">
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
                <li class='dropdown'>
                    <a href="#" class='dropdown-toggle' data-toggle='dropdown' >
                        {{ auth()->user()->fname }} <span class = "caret"></span>
                    </a>
                    <ul class="dropdown-menu " role = "menu">
                        <li>
                            <a href="{{ route('userProfile', ['fname' => auth()->user()->fname]) }}">
                                Your Profile
                            </a>
                        </li>
                        <li>
                            @can('restaurateur-user')
                                <a href="{{url('/restaurants')}}">
                                     My Restaurants
                                 </a>
                             @endcan
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout')}}">
                                Signout
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    @can('restaurateur-user')
                        <a href="{{url('restaurants')}}"> Reservations</a>
                    @endcan
                    @can('diner-user')
                        <a href="{{url('reservations/current')}}"> Reservations</a>
                    @endcan
                </li>
            @else
                <li><a href="{{ route('login') }}" target="_self">Login</a></li>
                <li><a href="{{ route('register') }}" target="_self">Register</a></li>
            @endcan
            <li><a href="#">Contact us</a></li>
            <li><a href="#">About us</a></li>

            @can('authenticated')
                <li>
                    <a href="{{url('/booking/cart')}}">
                        <i class='fa fa-opencart'></i> {{Cart::getTotalQuantity()}}
                    </a>
                </li>
            @endcan
        </ul>
      </div>
    </div>
</nav>
