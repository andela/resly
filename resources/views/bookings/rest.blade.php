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
    .float_left {
      float: left;
    }
  </style>
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

  <div class="content">
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
      </div>
    @empty
      <p> You have no Bookings. </p>
    @endforelse
  </div>
@endsection