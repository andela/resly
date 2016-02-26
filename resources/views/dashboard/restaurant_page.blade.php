@extends('layouts.master')

@section('title', $restaurant->name)

@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/dashboard.css') !!}">
@endsection
@section('content')
    <div class='container-wrapper'>
      <div class="container" style="padding:6% 0 20%;">
          <div class="row">
              <div class="col col-sm-3 col-md-3 sidebar">
                  <aside>
                    @include('partials.restaurant_sidebar')
                  </aside>
              </div>
              <div class="col col-sm-9 col-md-9 page">
                  <div class="row ">
                    <div class='col col-md-12 page-title'>
                        <h3> {{ $restaurant->name }} @yield('title-suffix')</h3>
                    </div>
                  </div>
                  @yield('details')
              </div>
          </div>
      </div>
    </div>
@endsection
