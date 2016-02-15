@extends('layouts.master')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
@endsection

@section('content')

  <div class="container" style="padding:6% 0 20%;">
      <div class="row">
          <div class="col-sm-3 col-md-2 sidebar" >
            <ul class="nav nav-sidebar" >
                <li style="margin-left:20px;">
                    <img src="http://placehold.it/350x150" height="50" width="50" style="border-radius:25px;" />
                </li>
                @can('rest-link')
                  <h3><small>Your Name</small></h3>
                  <li><a href="/restaurants/add">Add Restaurant</a></li>
                  <li><a href="#">Add Restaurant</a></li>
                  <li><a href="{{ action('RestaurantGalleryController@index') }}">Gallery</a></li>
                  <li><a href="#">Add Menu</a></li>
                  <li><a href="#">Add Wine</a></li>
                  <li><a href="{{ route('userProfile', ['username' => auth()->user()->username]) }}">Your Profile</a></li>
                  <li><a href="{{ route('userProfileEdit') }}">Edit Your Profile</a></li>
                @endcan
                @can('diner-link')
                  <h3><small>Your Name</small></h3>
                  <li><a href="#">Current Reservations</a></li>
                  <li><a href="#">Past Reservations</a></li>
                  <li><a href="#">Cancelled Reservations</a></li>
                  <li><a href="{{ route('userProfile', ['username' => auth()->user()->username]) }}">Your Profile</a></li>
                  <li><a href="{{ route('userProfileEdit') }}">Edit Your Profile</a></li>
                @endcan
            </ul>
          </div>
          <div class="col-sm-9 col-md-10">
            @yield('details')
          </div>
      </div>
  </div>
@endsection
