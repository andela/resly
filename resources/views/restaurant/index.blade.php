<link rel="stylesheet" type="text/css" href="{!! asset('css/restaurant.css') !!}">
@extends('dashboard.index')

@section('title', 'Restaurants') @endsection

@section('details')
        @if(count($restaurants) != 0)
            <div class="row">
                <div class="col col-md-6">
                    <h4>My Restaurants</h4>
                </div>
                <div class="col col-md-4">
                    {!! link_to('/restaurants/create', 'Add New Restaurant', ['class'=>'btn btn-primary block pull-right'])!!}
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Details</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($restaurants as $restaurant)
                        <tr>
                            <td>
                                {!! link_to('/restaurants/'.$restaurant->id, $restaurant->name, ['class'=>'restaurant-link'])!!}
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <tr>
                <td colspan="2" class="text-center">
                    <h3 class="text-muted">You have no restaurants yet</h3>
                    {!! link_to('/restaurants/create', 'Create Your First Restaurant', ['class'=>'btn btn-primary block'])!!}
                </td>
            </tr>
        @endif
@endsection