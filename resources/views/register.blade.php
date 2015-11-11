@extends('layouts.master')

@section('title', 'register')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/welcome.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('font-awesome/css/font-awesome.min.css') !!}">
@endsection;

@section('navbar')
  @include('partials.navbar')
@endsection

@section('content')
    <div class="register">
        <div class="container">
            <h3>Register</h3>
        </div>
    </div>
@endsection