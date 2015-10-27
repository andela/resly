@extends('layouts.master')

@section('title', 'bookings')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{!! asset('css/bookings.css') !!}">
  <style type="text/css">
    .content {
      margin-top: 80px;
    }
    .booking {
      width: 70%;
      margin: auto;
      padding: 4px;
      font-size: 140%;
      border: solid #82b1ff;
    }
    .no_booking {
      width: 70%;
      margin: auto;
      padding: 4px;
      font-size: 160%;
    }
    .float_left {
      float: left;
    }
  </style>
@endsection

@section('content')
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

  <div class="content">
    @include ('partials.alerts');
    @forelse($bookings as $booking)
      <div class="row booking">
        <div class="col-lg-6">
          <p>Restaurant Name: {{ $booking->table->restaurant->name }}</p>
          <p>Booking date: {{ $booking->booking_date }}</p>
          <p>Booking time: {{ $booking->booking_time }}</p>
        </div>
        <div class="col-lg-6">
          <p>Number of People</p>
          <h2 style="color:#2196f3">
            {{ $booking->number_of_people }}
          </h2>
        </div>
        <form method="post" action="{{ url('bookings/cancel') }}">
          {!! csrf_field() !!}
          <input name="booking_id" value="{{ $booking->id }}" type="hidden">
          <input type="submit" value="Cancel" class="btn btn-primary float_left">
        </form>
      </div>
    @empty
      <div class="row no_booking">
        <p> You have no Bookings. </p>
      </div>
    @endforelse
  </div>
@endsection