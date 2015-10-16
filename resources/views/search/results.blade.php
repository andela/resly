@extends('layouts.master')

@section('title', 'Results')

@section('styles')
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
            <form class="navbar-form navbar-left" role="search" action="{{ route('dinersearch') }}">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Find Restaurant">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::diner()->check())
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::diner()->get()->fname }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('dinersignout')}}">Signout</a></li>
                </ul>
              </li>
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
  <div class="container white">
      <h3>Results</h3>
      @if (! $results->count())
        <p>No results found, sorry</p>
      @else
        @foreach ($results as $result)
          <h3><a href="{{ route('restprofile', ['id' => $result->id])}}">{{ $result->getRestName()}}</a></h3>
        @endforeach
      @endif
    </div>
@endsection
