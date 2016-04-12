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
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th>Scheduled Date</th>
                                        <th>Restaurant Name</th>
                                        <th>Duration</th>
                                        <th>Cost</th>
                                        <th>Refund</th>
                                        <th>Cancelled Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $res)
                                        <tr>
                                            <td>{{$res->scheduled_date}}</td>
                                            <td>{{$res->restaurant()->name}}</td>
                                            <td>{{$res->duration}} hrs</td>
                                            <td>${{$res->cost}}</td>
                                            <td>${{$res->refund->credits}}</td>
                                            <td>{{$res->refund->created_at}}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <th colspan="6"><div class="">Total Refund - {{$user->totalRefund()}}</div></th>
                                        </tr>
                                </tbody>
                            </table>
                    @endif
                </div>
            </div>
        </div>
    </div>






        </div>
    </div>
@endsection
