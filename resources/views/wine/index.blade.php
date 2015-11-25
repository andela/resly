@extends('layouts.master')

@section('title', 'Create wine')

@if (! Auth::restaurateur()->check()) 
  @section('navbar')
    @include('partials.navbar')
  @endsection
@endif

@if (Auth::restaurateur()->check()) 
  @section('navbar')
    @include('partials.navbar')
  @endsection
@endif

@section('content')
<div class="container" style="padding-top:70px;">
  @if (Auth::restaurateur()->check()) 
    <h2>Add New Wine</h2>
    <a href="{{url('/wines/create')}}" class="btn btn-primary">Create Wine</a>     
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Year</th>
          <th>Description</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($wines as $wine)
        <tr>
          <td>{{ $wine->name }}</td>
          <td>{{ $wine->year }}</td>
          <td>{{ $wine->description }}</td>
          <td>Ksh {{ $wine->price }}</td>
          <td><a href="{{url('wines',$wine->id)}}" class="btn btn-primary">Read</a></td>
          <td><a href="{{route('wines.edit',$wine->id)}}" class="btn btn-warning">Update</a></td>
          <td>
            {!! Form::open(['method' => 'DELETE', 'route'=>['wines.destroy', $wine->id]]) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    <h3>Please login/register first to access this feature.</h3>
  @endif
</div>
@endsection
