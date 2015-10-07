@extends('layouts.master')

@section('title', 'bookings')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bookings.css') !!}">
@endsection

@section('content')
    <div class="container">
    <table>
      <tbody>
      @foreach ($slots as $slot)
        <tr>
          <td>$slot->starting</td>
          <td>$slot->finishing</td>
          <td>
            @if ($slot->isFree())
              <form method="POST" action="/bookings/create">
                {!! csrf_field() !!}
                <input type="hidden" name="table_id" value="{{$table_id}}">
                <input type="hidden" name="booking_time" value="{{$slot->starting}}">
                <input type="submit">
              </form>
            @else
              booked
            @endif
          </td>
        </tr>
      @endforeach
      </tbody>
    <table>
    </div>
@endsection