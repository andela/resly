@extends('dashboard.restaurant')

@section('title', 'Restaurant')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Restaurant: {{$restaurant->name}}</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class='col col-md-12'>
                    <p class='resly-breadcrumb'> <a href='/restaurants'>Restaurants</a> &gt;&gt; {{$restaurant->name}}</p>
                    {!! link_to(url('/restaurants/'.$restaurant->id.'/tables'), 'Add Table', ['class'=>'btn btn-sm btn-primary']) !!}
                    {!! link_to(url('/gallery/'.$restaurant->id), 'Gallery', ['class'=>'btn btn-sm btn-primary']) !!}

                    @if(count($tables) ==  0)
                        <div class='not-available-label'>
                            <h3 class="text-muted text-center">You have no tables in this restaurant</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
