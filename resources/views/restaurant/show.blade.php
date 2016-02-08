<link rel="stylesheet" type="text/css" href="{!! asset('css/restaurant.css') !!}">
@extends('dashboard.index')

@section('title', 'Restaurant')

@section('details')
    {!! link_to(url('/restaurants/'.$restaurant->id.'/tables'), 'Add Table', ['class'=>'btn btn-sm btn-primary']) !!}
    {!! link_to(url('/restaurant/'.$restaurant->id.'/create'), 'Add Wine', ['class'=>'btn btn-sm btn-primary']) !!}

@endsection