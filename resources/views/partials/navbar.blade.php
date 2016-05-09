<nav class="navbar navbar-static-top navbar-resly">

    <div class="container">

        <div class="row">
                <div class="col-md-2">
                        <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                    <a class="navbar-brand" href="/">Resly</a>
                        </div>
                </div>

                <div class="col-md-4">
                    <div class="">
                        @if(Request::path() != "/")
                            @include('partials.search')
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                                @can('authenticated')
                                    <li>
                                        @can('restaurateur-user')
                                            <a href="{{url('restaurants')}}"> Reservations</a>
                                        @endcan
                                        @can('diner-user')
                                            <a href="{{url('reservations/current')}}"> Reservations</a>
                                        @endcan
                                    </li>
                                @endcan

                                <li><a href="#">Restaurants</a></li>

                                @can('authenticated')
                                    <li>
                                        <a href="{{url('/booking/cart')}}">
                                            <i class='fa fa-opencart'></i> {{Cart::getTotalQuantity()}}
                                        </a>
                                    </li>
                                    <li class='dropdown'>
                                        <a href="#" class='dropdown-toggle' data-toggle='dropdown' >
                                            {{ auth()->user()->username }} <span class = "caret"></span>
                                        </a>
                                        <ul class="dropdown-menu " role = "menu">
                                            <li><a href="{{ route('userProfile') }}">Your Profile</a></li>
                                            <li>
                                                @can('restaurateur-user')
                                                    <a href="{{url('/restaurants')}}">My Restaurants</a>
                                                @endcan
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="{{ route('logout')}}">Signout</a></li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{ route('login') }}" target="_self">Login</a></li>
                                    <li><a href="{{ route('register') }}" target="_self">Register</a></li>
                                @endcan
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</nav>