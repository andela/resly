@extends('layouts.master')

@section('title', 'Resly | A one stop shop for your reservation needs')

@section('styles')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">
<link rel="stylesheet" type="text/css" href="{!! asset('css/navbar-fixed-top.css') !!}">
@endsection

@section('navbar')
  <nav class="navbar navbar-default navbar-fixed-top">
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
        <ul class="nav navbar-nav">
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          @if (Auth::diner()->check())
            <div class = "btn-group flow-group">
              <button type="button" class="btn btn-default">
                {{ Auth::diner()->get()->fname }}
              </button>
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle = "dropdown">
                <span class = "caret"></span>
              </button>
              <ul class="dropdown-menu" role = "menu">
                <li><a href="#">Your Profile</a></li>
                <li><a href="#">Help</a></li>
                <li class="divider"></li>
                <li><a href="#">Settings</a></li>
                <li><a href="{{ route('dinersignout')}}">Signout</a></li>
              </ul>
            </div>
          @else
            <li><a href="{{ route('dinersignin')}}">Login</a></li>
            <li><a href="{{ route('dinersignup')}}">Register</a></li>
          @endif
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
@endsection

@section('content')
  <div class="container">
    @include('partials.alerts')
  </div>
@endsection
