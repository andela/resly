<link rel="stylesheet" type="text/css" href="{!! asset('css/restaurant.css') !!}">
@extends('dashboard.index')

@section('title', 'Restaurant')

@section('details')
    <h2 style="margin-top: 0px;">{{$restaurant->name}}</h2>
@endsection