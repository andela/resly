@extends('dashboard.index')
@section('title', 'Current Reservations')

@section('details')
    <div class='panel panel-danger' >
        <div class='panel-heading'>
            Cancelled Reservations
        </div>
        <div class='panel-body'>
        @if(count($reservations) == 0)
            <p>You have no cancelled reservations</p>
        @else
            @foreach($reservations as $res)
                <p><strong>Restaurant Name: </strong> {{$res->restaurant()->name}}</p>
                <p><strong>Scheduled Date: </strong> {{$res->scheduled_date}}</p>
                <p><strong>Duration:</strong> {{$res->duration}} hrs</p>
                <p><strong>Cost:</strong> ${{$res->cost}}</p>
                <hr/>
            @endforeach
        @endif
        </div>
    </div>
@endsection