@extends('dashboard.index')
@section('title', 'Current Reservations')

@section('details')
    @include('partials.alerts')
    <div class='panel panel-primary' >
        <div class='panel-heading'>
            Current Reservations
        </div>
        <div class='panel-body'>
        @if(count($reservations) == 0)
            <p>You have no current reservations</p>
        @else
            @foreach($reservations as $res)
                <p><strong>Restaurant Name: </strong> {{$res->restaurant()->name}}</p>
                <p><strong>Scheduled Date: </strong> {{$res->scheduled_date}}</p>
                <p><strong>Duration:</strong> {{$res->duration}} hrs</p>
                <p><strong>Cost:</strong> ${{$res->cost}}</p>
                <a href="/reservations/cancel/{{$res->id}}">Cancel Reservation</a>
                <hr/>
            @endforeach
        @endif
        </div>
    </div>
@endsection