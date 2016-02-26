@extends('dashboard.restaurant_page')

@section('title-suffix', '- Home')
@section('details')
    @parent
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class='row'>
                <div class='col-md-6'>
                    <p> <i class='fa fa-map-marker'></i> {{$restaurant->address}}</p>
                </div>
                <div class='col-md-6'>
                    <p> <i class='fa fa-phone'></i> {{$restaurant->telephone}} </p>
                </div>
            </div>

            <div class='row'>
                <div class='col-md-6'>
                    <p> <i class='fa fa-envelope'></i> {{$restaurant->email}} </p>
                </div>
                <div class='col-md-6'>
                    <p> <i class='fa fa-clock-o'></i> {{$restaurant->opening_time}} - {{$restaurant->closing_time}} </p>
                </div>
            </div>

            <strong> {{ $restaurant->description }} </strong>
        </div>
    </div>
@endsection