@extends('dashboard.index')
@section('title', 'Visited Restaurants')

@section('details')
    @include('partials.alerts')
    <div class='panel panel-primary' >
        <div class='panel-heading'>
           Visited Restaurants
        </div>
        <div class='panel-body'>
        @if($visitedRestaurants->isEmpty())
            <p>You have not visited any restaurant yet.</p>
        @else
            @foreach($visitedRestaurants as $restaurant)
                <p><strong>Restaurant Name: </strong> {{$restaurant->name}}</p>
                <hr/>
            @endforeach
        @endif
        </div>
    </div>
@endsection