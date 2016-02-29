{{-- @extends('layouts.master') --}}

@section('title', 'welcome')

@section('styles')
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato:400,100' rel='stylesheet' type='text/css'>
  {{-- <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}"> --}}
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.carousel.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.theme.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.transitions.css') !!}">
  {{-- <link rel="stylesheet" type="text/css" href="{!! asset('css/rest-closeby.css') !!}"> --}}
@endsection

@section('content')
    @include ('partials.alerts')
    <div id="hero">
        <div class="hero-image"></div>
        <div class='hero-overlay'></div>
        <div class='hero-content'>
            <h1 class='welcome-text'>The new way of dining</h1>
            <h5>Search &amp; book your restaurant table</h5>
            <form action="{{ route('searchsite') }}" class=''>
                <div class="row">
                    <div class="col col-sm-5 col-lg-8 col-md-8">
                        <div class="input-group">
                            <span class='input-group-addon'><i class='fa fa-search'></i></span>
                            <input type="text" class="form-control" name="query" placeholder="Search for restaurant... name or location">
                        </div>
                    </div>

                    <div class="col col-sm-2 col-md-2 col-lg-2">
                        <div class='input-group'>
                            <select class='form-control'>
                                @foreach (range(1, 10) as $option)
                                    <option value="{{$option}}">{{$option}} seat</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class='col col-sm-2 col-md-2 col-lg-2'>
                        <button class="btn btn-default" type="submit">Go!</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="belt">
        <h5><i class='fa fa-glass'></i> Featured restaurants</h5>
    </div>

    <div class="container ">
        <div class="row">
            <div id='featured-restaurant-scroller' class='owl-carousel'>
                @foreach($featuredRestaurants as $index=>$restaurant)
                    <div class="restaurant-cell">
                        <a href="{{url('restaurants/page/'.$restaurant->id)}}" >
                            @if(count($restaurant->pictures) != 0)
                                <img src="http://res.cloudinary.com/ddnvpqjmh/image/upload/c_fill,h_300,w_300/{{$restaurant->pictures->first()->filename}}" class="thumbnail"/>
                            @else
                                <img src="http://lorempixel.com/300/300/food/{{$index}}" class="thumbnail"/>
                            @endif
                            <div class='restaurant-info'>
                                <h5 class='restaurant-title'>
                                    {{$restaurant->name}}
                                    <span class='price pull-right'>
                                        ${{number_format((rand(20, 200)/10), 2)}}
                                    </span>
                                </h5>

                                <div class="info">
                                    {{$restaurant->description}}
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>


    <div class="belt" id='feature-rest' style="display:none">
        <h5> <i class="fa fa-street-view"></i> Restaurants Closeby</h5>
    </div>
    <div class="container">
        <div class="row" id="closeby-restaurants">
            <h5 style="display:none" id='feature-cont'>
                <i class="fa fa-spinner fa-spin"></i>
                Fetching restaurants close to you...
            </h5>
        </div>
    </div>


    <div class="belt">
        <h5><i class="fa fa-bolt"></i> Latest restaurants</h5>
    </div>
    <div id="latest-restaurants-section">
        <div class='container'>
            <div class='row'>
                @foreach($latestRestaurants as $restaurant)
                    <div class='col col-md-4'>
                        <ul class='latest-restaurant-items'>
                            <li>
                                <span class='title'>
                                    <a href="{{url('restaurants/page/'.$restaurant->id)}}">{{$restaurant->name}}</a>
                                    <strong class="pull-right price">${{number_format((rand(10, 50 )/10), 2)}}</strong>
                                </span>
                                <p class='info short'>
                                    {{$restaurant->description}} Si ut domesticarum et e fugiat instituendarum o senserit an cernantur an noster
                                    et arbitror ita lorem, vidisse varias proident quamquam ita nescius non
                                </p>
                            </li>
                        </ul>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
@endsection
@section('scripts')
  <script type='text/javascript' src="{!! asset('owl-carousel/owl.carousel.min.js') !!}"></script>
  {{-- <script type='text/javascript' src="{!! asset('js/ellipsis.js') !!}"></script> --}}
  <script type='text/javascript' src="{!! asset('js/welcome.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('js/search_form_verification.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('js/geolocation.js') !!}"></script>
@endsection
