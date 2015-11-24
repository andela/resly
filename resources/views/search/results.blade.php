@extends('layouts.master')

@section('title', 'Results')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/navbar-fixed-top.css') !!}">
  <style type="text/css">
    .result {
      margin-bottom: 2px;
      padding: 4px;
      border-top: 2px solid #82b1ff;
      border-bottom: 2px solid #82b1ff;
    }
    .description {
      font-style: italic;
    }
  </style>
@endsection

@section('content')
  <div class="container white">
    <h4>Results</h4>
    @if (! $results->count())
      <p>No results found, sorry</p>
    @else
      @foreach ($results as $result)
      <div class="row result">
        <div class="col-lg-6">
          <h5>
            <a href="{{ route('restprofile', ['id' => $result->id])}}">
              {{ $result->getRestName()}}
            </a>
          </h5>
          <p>
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
            {{ $result->location }} | {{ $result->address }}
          </p>
          <p class="description">
            "{{ strlen($result->description) > 40 ? 
              substr($result->description, 0, 40) . "..." : 
              $result->description 
            }}"
          </p>
        </div>
        <div class="col-lg-6">
          <p>Tables</p>
          <h2 style="color:#2196f3">
            {{ $result->tables->count() }}
          </h2>
        </div>
      </div>
      @endforeach
    @endif
    <a class = "btn btn-primary" href="/">Back</a>
  </div>
@endsection
