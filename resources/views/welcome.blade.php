@extends('layouts.master')

@section('title', 'welcome')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
@endsection;

@section('navbar')
  @include('partials.navbar')
@endsection

@section('content')
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

  <footer>
    <div class="footer">
      <div class="container">
        <div class="footer-inner">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="footer-content text-center padding-ver-clear">
                <p>Resly | Home for your reservation needs.</p>
                <ul class="list-inline mb-20">
                  <li><i class="text-default fa fa-map-marker pr-5"></i>One infinity loop, 54100</li>
                  <li><a href="tel:+00 1234567890" class="link-dark"><i class="text-default fa fa-phone pl-10 pr-5"></i>+00 1234567890</a></li>
                  <li><a href="mailto:info@theproject.com" class="link-dark"><i class="text-default fa fa-envelope-o pl-10 pr-5"></i>info@resly.com</a></li>
                </ul>
                <ul class="social-links circle animated-effect-1 margin-clear">
                  <div class="social">
                    <ul>
                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-google-plus"></i> </a></li>
                    </ul>
                  </div>
                </ul>
                <div class="separator"></div>
                <p class="text-center margin-clear">Copyright © 2015 Resly <a target="_blank" href="http://resly.me">Resly</a>. All Rights Reserved</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- .footer end -->
  </footer>
@endsection