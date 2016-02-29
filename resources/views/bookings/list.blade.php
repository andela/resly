@extends('dashboard.restaurant')

@section('title', 'Restaurant')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Restaurant Tables: {{$restaurant->name}}</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class='col col-md-12'>
                    <p class='resly-breadcrumb'> 
                        <a href='/restaurants'>Restaurants</a> &gt;&gt; 
                        <a href='/restaurants/{{$restaurant->id}}'>{{$restaurant->name}}</a> &gt;&gt; 
                        {{$table->label}}
                    </p>
                    {!! link_to(url('/restaurants/'.$restaurant->id.'/tables'), 'Add Table', ['class'=>'btn btn-sm btn-primary']) !!}
                    {!! link_to(url('/gallery/'.$restaurant->id), 'Gallery', ['class'=>'btn btn-sm btn-primary']) !!}
                    <table class="table">
                        <thead>
                            <tr>
                                <td colspan="5"><h4 class="text-center">Table Bookings</h4></td>
                            </tr>
                            <tr>
                                <td>SN</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Time</td>
                                <td>Duration</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $index=>$booking)
                            <tr>
                                <td>{{ $index + 1}} </td>
                                <td>{{ $booking->user->fname .' '. $booking->user->lname }}</td>
                                <td>{{ $booking->user->email }}</td>
                                <td>{{ $booking->scheduled_date }}</td>
                                <td>{{ $booking->duration }}hrs</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
