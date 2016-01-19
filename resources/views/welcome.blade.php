@extends('layouts.master')

@section('title', 'welcome')

@section('styles')
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato:400,100' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.carousel.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.theme.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.transitions.css') !!}">
@endsection

@section('content')
@include ('partials.alerts');
  <div class="home">
    @if(Session::has('flash_message'))
      <div class="alert flash-message">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ Session::get('flash_message') }}
      </div>
    @endif
    <div class="home-info">
      <h1>The new way of dining</h1>
      <h4><em>Make a reservation</em></h4>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class = "search-form">
            <form role="form" action="{{ route('searchsite') }}">
              <div class="form-group">
               <div class="input-group input-group-lg col-lg-12 searching">
                 <span class="input-group-addon">
                   <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                 </span>
                 <input type="text" name="query" class="form-control" placeholder="Location or Restaurant" dir = "auto">
                 <span class = "input-group-btn">
                    <button type="submit" class="btn btn-primary">Find</button>
                 </span>
               </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="belt">
        <h5>Featured restaurants</h5>
    </div>
   <div id="contents">
    <div class="container">
      <div class="row">
        <div id='featured-restaurant-scroller' class='owl-carousel'>
          @foreach($featuredRestaurants as $restaurant)
            <div class="item">
              <div class="cell">
                <a href="#" class="thumbnail">
                  <img src="http://lorempixel.com/400/200/food"/>
                  <div class='restaurant-info'>
                    <h5 class='restaurant-title'>{{$restaurant->name}}</h5>
                    <p class='info'>
                      {{$restaurant->description}}orum arbitror,
                      proident ab minim, non anim fabulas doctrina in ita sunt quo multos ut se elit
                      fore e cupidatat, iis nescius iis consequat
                    </p>
                    <p class='price'>
                      ${{number_format((rand(200, 2000)/10), 2)}}
                    </p>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
            </div>
        </div>

    </div>
  </div>
<div class="belt">
    <h5>Latest restaurants</h5>
</div>
<div id="latest-restaurants-section">
    <div class='container'>
        <div class='row'>
            @foreach($latestRestaurants as $restaurant)
                <div class='col col-md-4'>
                    <ul class='latest-restaurant-items'>
                        <li>
                            <span class='title'><a href="#">{{$restaurant->name}}</a></span>
                            <p class='info short'>
                                Si ut domesticarum et e fugiat instituendarum o senserit an cernantur an noster
                                et arbitror ita lorem, vidisse varias proident quamquam ita nescius non
                                <strong class="pull-right price">${{number_format((rand(200, 2000)/10), 2)}}</strong>
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
  <script type='text/javascript' src="{!! asset('js/ellipsis.js') !!}"></script>

  <script type='text/javascript' src="{!! asset('js/welcome.js') !!}"></script>
@endsection
