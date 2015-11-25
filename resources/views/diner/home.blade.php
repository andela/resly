@extends('layouts.master')

@section('title', 'Resly | A one stop shop for your reservation needs')

@section('styles')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">
<link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('css/navbar-fixed-top.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('css/auth.css') !!}">
@endsection


@section('content')
  @include ('partials.alerts');
  @if (! Auth::check())
  <div class="container">
      <h1> Welcome to diner Homepage</h1>
  </div>
@else
@endif
@endsection