@extends('layouts.master')

@section('title', 'login')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
@endsection;

@section('navbar')
  @include('partials.navbar')
@endsection

@section('content')
    <div class="login">
        <div class="container">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_a" data-toggle="tab">Diner</a></li>
              <li><a href="#tab_b" data-toggle="tab">Restaurateur</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_a">
                    <h3>Hello</h3>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                        ac turpis egestas.</p>
                </div>
                <div class="tab-pane" id="tab_b">
                    <h3>Hello</h3>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                        ac turpis egestas.</p>
                </div>
            </div><!-- tab content -->
        </div><!-- end of container -->
    </div>
@endsection