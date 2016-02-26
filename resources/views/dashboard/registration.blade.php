@extends('layouts.master')

@section('title', 'Search')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/dashboard.css') !!}">
@endsection
@section('content')
    <div class='container-wrapper'>
      <div class="container" style="padding:6% 0 0">
          <div class="row">
              <div class='col col-md-8 col-md-offset-2 page'>
                  @yield('details')
              </div>
          </div>
      </div>
    </div>
@endsection
