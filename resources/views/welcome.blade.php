@extends('layouts.master')

@section('title', 'welcome')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
@endsection

@section('content')
@include ('partials.alerts');
  <div class="home">
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
  <div id="content">
    <div class="container">
        <div class="row">
            <div class='col-xs-12 col-md-12 col-lg-12'>
                <h5>Latest Restaurants</h5>
            </div>
            @foreach($latestRestaurants as $restaurnat)
                <div class="col-xs-6 col-md-3">
                  <div class="cell">
                      <a href="#" class="thumbnail">
                        <img src="http://www.hotwheels-elite.com/diecast-model-cars/images/Image/hot-wheels-elite/image_not_available.jpg" alt="...">
                        <span class="label label-primary">{{$restaurnat->name}}</span>
                      </a>
                  </div>
                </div>
            @endforeach
        </div>

    </div>
  </div>

  <div id="content">
    <div class="container">
        <div class="row">
            <div class='col-xs-12 col-md-12 col-lg-12'>
                <h5>Featured Restaurants</h5>
            </div>
            @foreach($featuredRestaurants as $restaurnat)
            <div class="col-xs-12 col-md-3">
              <div class="cell">
                  <a href="#" class="thumbnail">
                    <img src="http://www.hotwheels-elite.com/diecast-model-cars/images/Image/hot-wheels-elite/image_not_available.jpg" alt="...">
                      <span class="label label-primary">{{$restaurnat->name}}</span>
                  </a>
              </div>
            </div>
            @endforeach
        </div>
    </div>
  </div>
@endsection
