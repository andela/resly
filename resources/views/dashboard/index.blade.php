@extends('layouts.master')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/dashboard.css') !!}">
@endsection
@section('content')
    <div class='container-wrapper'>
      <div class="container" style="padding:6% 0 20%;">
          <div class="row">
              <div class="col col-sm-3 col-md-3 sidebar">
                  <aside>
                      @can('restaurateur-user')
                          @include('partials.restaurateur_sidenav')
                      @else
                          @include('partials.diner_sidenav')
                      @endcan
                  </aside>
              </div>


              <div class="col col-sm-9 col-md-9">
                  @yield('details')
              </div>
          </div>
      </div>
    </div>
@endsection
