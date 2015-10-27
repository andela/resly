@extends('layouts.master')

@section('title', 'bookings')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bookings.css') !!}">
    <style type="text/css">
        .content {
            margin-top: 80px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        @forelse($bookings as $booking)
            <p>{{ $booking }}</p>
        @empty
            <p> You have no Bookings. </p>
        @endforelse
    </div>
@endsection