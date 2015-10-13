@extends('layouts.master')

@section('title', 'bookings')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bookings.css') !!}">
@endsection

@section('content')
    <div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <td>starting</td>
          <td>finishing</td>
        </tr>
      </thead>
      <tbody>
      @foreach ($slots as $slot)
        <tr>
          <td>@datetime( $slot->startingTime() )</td>
          <td>@datetime( $slot->finishingTime() )</td>
          <td>
            @if ($slot->isFree())
              <form method="POST" action="/bookings/create">
                {!! csrf_field() !!}
                <input type="hidden" name="booking_time" value="@datetime( $slot->startingTime() )">
                <input type="hidden" name="table_id" value="{{$table_id}}">
                <input type="hidden" name="booking_date" value="{{$booking_date}}">
                <input type="hidden" name="number_of_people" value="{{$number_of_people}}">
                <input type="submit" value="book this slot">
              </form>
            @else
              booked
            @endif
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    </div>
@endsection