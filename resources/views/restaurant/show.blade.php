@extends('dashboard.restaurant')

@section('title', 'Restaurant')

@section('details')
    @parent
    <p>
        <a href='/restaurants'>Restaurants</a> >> {{$restaurant->name}}
    </p>
    
    {!! link_to(url('/restaurants/'.$restaurant->id.'/tables'), 'Add Table', ['class'=>'btn btn-sm btn-primary']) !!}
    {!! link_to(url('/gallery/'.$restaurant->id), 'Gallery', ['class'=>'btn btn-sm btn-primary']) !!}
    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(count($tables) ==  0)
        <h3 class="text-muted text-center">You have no tables in this restaurant</h3>
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
                    <td>Number of seats taken</td>
                    <td>Cost</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($tables as $index=>$table)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$table->label}}</td>
                        <td>{{$table->seats_number}}</td>
                        <td>{{$table->seats_taken}}</td>
                        <td>{{number_format($table->cost, 2)}}</td>
                        <td>
                            <a href="{{url("/tables/$table->id/edit/")}}" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            {!! Form::open(['url'=>url("/tables/$table->id/delete/"),
                             'method'=>'delete','class'=>'inline-form']) !!}
                                <button type="submit" name="delete"><i class="fa fa-trash"></i></button>
                            {!! Form::close()!!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection