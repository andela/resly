@extends('dashboard.index')
@section('title', 'Current Reservations')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Cancelled Reservations</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class="col col-md-12">
                    @if(count($reservations) == 0)
                        <div class='not-available-label'>
                            <h3>You have no cancelled reservations</h3>
                        </div>
                    @else
                        @foreach($reservations as $res)
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
                                        <tr>
                                            <td>{{$res->scheduled_date}}</td>
                                            <td>{{$res->restaurant()->name}}</td>
                                            <td>{{$res->duration}} hrs</td>
                                            <td>${{$res->cost}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>






        </div>
    </div>
@endsection
