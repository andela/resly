@extends('layouts.master')

@section('title', 'welcome')


@section('content')
    <div class="container">

      <div id="banner">
        <div class="inner">
            <h1>Welcome to resly <small>the new way to dine</small></h1>
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