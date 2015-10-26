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
    @include ('partials.alerts');
    <div class="row">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="container">
        
        <div class="col-lg-6 white">
            <h2>Welcome to {{$rest->name}}</h2>
            <p>{{$rest->location}}<p>
            <p>{{$rest-> opening_time}}</p>
        </div>
        <div class="col-lg-6 white">
            <h2> Availability </h2>

            <form method="POST" action="/bookings/begin">
            {{csrf_field()}}
            <input type="hidden" name="restaurant_id" value="{{$rest->id}}">
            <div class="form-group">
                <label for="inputNumberOfPeople">Number of people</label>
                <input type="number" class="form-control" id="inputNumberOfPeople" name="number_of_people" placeholder="1">
            </div>
            <div class="form-group">
                <label for="inputBookingDate">Booking date</label>
                <input type="date" class="form-control" id="inputBookingDate" placeholder="dd/mm/yy" name="booking_date">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>

    
@stop