@extends('layouts.master')

@section('title', 'Results')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/auth.css') !!}">
@endsection

@section('navbar')
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ route('resthome')}}">Resly</a>
   </div>
@endsection

@section('content')

    <div class="container">
        <div class="col-lg-6 white">
            <h2>Welcome to {{$rest->name}}</h2>
            <p>{{$rest->location}}<p>
            <p>{{$rest-> opening_time}}</p>
        </div>
    </div>
    
@stop