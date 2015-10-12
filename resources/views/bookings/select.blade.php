@extends('layouts.master')

@section('title', 'choose a time')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bookings.css') !!}">
@endsection

@section('content')
    <div class="container">
        <form action="bookings/begin" method="POST">
          {!! csrf_field() !!}
          <div class="form-group">
            <label for="bookingDate">Booking Date</label>
            <input type="datetime" class="form-control" id="bookingDate" name="booking_date">
          </div>
          <div class="form-group">
            <label for="numberOfPeople">Number of people</label>
            <input type="number" class="form-control" id="numberOfPeople" name="number_of_people" placeholder="1">
          </div>
          <button type="submit" class="btn btn-default">See availability</button>
        </form>
    </div>
@endsection