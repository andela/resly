
@extends('dashboard.index')

@section('title', 'Restaurants')
@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>My Restaurants</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class='col col-md-12'>
                    @if(count($restaurants) != 0)
                        {!! link_to('/restaurants/create', 'Add New Restaurant', ['class'=>'btn btn-primary block pull-right'])!!}
                        <table class="table table-item-list table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th>Reservations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($restaurants as $restaurant)
                                    <tr>
                                        <td>
                                            {!! link_to('/restaurants/'.$restaurant->id, $restaurant->name, ['class'=>'restaurant-link'])!!}
                                        </td>
                                        <td>
                                            <a href="#" class='action-link'><i class='fa fa-pencil '></i></a>
                                            <a href="#" class='action-link'><i class='fa fa-times'></i></a>
                                        </td>
                                        <td>
                                            {{count($restaurant->bookings()->where('status', 1)->where('scheduled_date', '>', \Carbon\Carbon::now()->toDateTimeString())->get()) }} Reservations
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class='not-available-label'>
                            <h3 class="text-muted">You have no restaurants yet</h3>
                            {!! link_to('/restaurants/create', 'Create Your First Restaurant', ['class'=>'btn btn-primary block'])!!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
