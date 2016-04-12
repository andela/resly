@extends('dashboard.index')
@section('title', 'Current Reservations')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Current Reservations</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class='col col-md-12'>
                    @include('partials.alerts')
                    @if(count($reservations) == 0)
                        <div class='not-available-label'>
                            <h3>You have no current reservations</h3>
                        </div>
                    @else
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>Scheduled Date</th>
                                    <th>Restaurant Name</th>
                                    <th>Duration</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $res)
                                    <tr class="res-row">
                                        <td>{{$res->scheduled_date}}</td>
                                        <td>{{$res->restaurant()->name}}</td>
                                        <td>{{$res->duration}} hrs</td>
                                        <td>${{$res->cost}}</td>
                                        <td><a title="Cancel" class="confirm" id="{{$res->id}}"><i class='fa fa-times'></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
