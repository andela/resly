@extends('layouts.master')

@section('title', 'Results')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/navbar-fixed-top.css') !!}">
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
      <a class = "btn btn-primary" href="/">Back</a>
    </div>
@endsection
