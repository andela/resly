@extends('layouts.master')

@section('title', 'welcome')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
@endsection;

@section('navbar')
  <ul class="nav navbar-nav navbar-right">
    <li><a href="/diner" target="_self">Diner</a></li>
    <li><a href="/rest" target="_self">Restaurateur</a></li>
  </ul>
@endsection


@section('content')
    <div class="container">

      <div id="banner">
        <div class="inner">
            <h1>The new way of dining</h1>
        </div>

        <div class = "search-form">
          <form role="form" action="{{ route('searchsite') }}">
            <div class="form-group">
             <div class="input-group input-group-lg col-lg-6 searching">
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

    <div id="content">
            <div class="container">
                <div class="row">
                  <div class="col-xs-6 col-md-3">
                    <div class="cell">
                        <a href="#" class="thumbnail">
                          <img src="/img/search.jpg" alt="...">
                        </a>
                    </div>
                    
                  </div>
                  <div class="col-xs-6 col-md-3">
                    <div class="cell">
                        <a href="#" class="thumbnail">
                          <img src="/img/reservation.jpg" alt="...">
                        </a>
                    </div>
                    
                  </div>
                  <div class="col-xs-6 col-md-3">
                    <div class="cell">
                       <a href="#" class="thumbnail">
                         <img src="/img/menu.jpg" alt="...">
                       </a> 
                    </div>
                    
                  </div>
                  <div class="col-xs-6 col-md-3">
                    <div class="cell">
                        <a href="#" class="thumbnail">
                          <img src="/img/wine.jpg" alt="...">
                        </a>
                    </div>
                    
                  </div>
                </div>
            </div>
    </div>
@endsection