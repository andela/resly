@extends('layouts.master')

@section('title', 'Create wine')

@if (Auth::restaurateur()->check()) 
  @section('navbar')
    @include('partials.navbar')
  @endsection
@endif

@section('content')
<div class="container" style="padding-top:70px;">
  <h1>Show Wine</h1>
  
    <form class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder={{ $wine->name }} readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="year" class="col-sm-2 control-label">Year</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="year" placeholder={{ $wine->year }} readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="description" placeholder={{ $wine->description }} readonly ></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="price" placeholder={{ $wine->price }} readonly>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="{{ url('wines')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection
