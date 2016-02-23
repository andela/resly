@extends('layouts.master')

@section('title', 'welcome')

@section('styles')
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato:400,100' rel='stylesheet' type='text/css'>
  {{-- <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.carousel.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.theme.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('owl-carousel/owl.transitions.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('css/rest-closeby.css') !!}"> --}}
@endsection

@section('content')
    @include ('partials.alerts')
    <div id="hero">
        <div class="hero-image"></div>
        <div class='hero-content'>
            <h1 class='welcome-text'>The new way of dining</h1>
            
            <form action="{{ route('searchsite') }}">
                <i class='fa fa-search'></i>
                <input type="text" id='query' name="query"  required placeholder="Location or Restaurant" dir = "auto">
                <select>
                    @@foreach (range(1, 10) as $option)
                        <option value="{{$option}}">{{$option}} seat</option>
                    @endforeach
                </select>

                <button type="submit" id='search-button' class="btn btn-default" >Search for restaurant closest to you</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
  <script type='text/javascript' src="{!! asset('owl-carousel/owl.carousel.min.js') !!}"></script>
  <script type='text/javascript' src="{!! asset('js/ellipsis.js') !!}"></script>
  <script type='text/javascript' src="{!! asset('js/welcome.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('js/search_form_verification.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('js/geolocation.js') !!}"></script>
@endsection
