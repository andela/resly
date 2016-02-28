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
                    <p class='resly-breadcrumb'> <a href='/restaurants'>Restaurants</a> &gt;&gt; {{$restaurant->name}}</p>
                    {!! link_to(url('/restaurants/'.$restaurant->id.'/tables'), 'Add Table', ['class'=>'btn btn-sm btn-primary']) !!}
                    {!! link_to(url('/gallery/'.$restaurant->id), 'Gallery', ['class'=>'btn btn-sm btn-primary']) !!}

                    @if(count($tables) ==  0)
                        <div class='not-available-label'>
                            <h3 class="text-muted text-center">You have no tables in this restaurant</h3>
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <td colspan="5"><h4 class="text-center">Seats in restaurant</h4></td>
                                </tr>
                                <tr>
                                    <td>SN</td>
                                    <td>Name</td>
                                    <td>Number of seats</td>
                                    <td>Cost</td>
                                    <td class='status'>Bookings</td>
                                    <td class='action'>Action</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tables as $index=>$table)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$table->label}}</td>
                                        <td>{{$table->seats_number}}</td>
                                        <td>$ {{number_format($table->cost, 2)}}</td>
                                        <td class='status booked'>{{count($table->bookings()->get())}}</td>
                                        <td class='action'>
                                            <a href="{{url("/tables/$table->id/edit/")}}" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            {!! Form::open(['url'=>url("/tables/$table->id/delete/"),
                                             'method'=>'delete','class'=>'inline-form delete-form']) !!}
                                                <button type="submit" name="delete"><i class="fa fa-trash"></i></button>
                                            {!! Form::close()!!}
                                            <a href='/bookings/{{$table->id}}'>
                                                <i class='fa fa-eye'></i>
                                            </a>
                                        </td>
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
