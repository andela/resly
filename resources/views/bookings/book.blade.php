@extends('dashboard.restaurant_page')

@section('styles')
    @parent
    <link rel="stylesheet" type="text/css" href="{!! asset('css/jquery.datetimepicker.css') !!}">
@endsection

@section('title-suffix', '- Tables')
@section('details')
    @parent
    @include ('partials.alerts')

    <div class="row">
        <div class='col col-md-12 page-body'>
            <div class='row'>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                 <div class="col-lg-9 white">
                    <p>{{$restaurant->location}}</p>
                    <p><i class='fa fa-clock-o'></i> {{$restaurant-> opening_time}}</p>
                    <p style="color:red;">* please note that the cost shown is for only one hour</p>
                    <table class="table">
                        <thead>
                            <th>SN</th>
                            <th>Table Name</th>
                            <th>Seats</th>
                            <th>Cost per hour</th>
                            <th>Book</th>
                        </thead>
                        <tbody>
                            @foreach ($restaurant->tables as $index => $table )
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$table->label}}</td>
                                    <td>{{$table->seats_number}}</td>
                                    <td>$ {{number_format($table->cost)}}</td>
                                    <td>
                                        <form action="{{url('/booking/table/'.$table->id.'/add')}}" method='post'>
                                            {{csrf_field()}}
                                            <div class="input-group">
                                                <label>Date </label>
                                                <input type='text' class='bookDate' name='date'>
                                            </div>
                                            <div class="input-group">
                                                <label>Duration</label>
                                                <select name='duration'>
                                                    <option value="1"> 1 Hour </option>
                                                    <option value="2"> 2 Hours </option>
                                                    <option value="3"> 3 Hours </option>
                                                    <option value="4"> 4 Hours </option>
                                                    <option value="5"> 5 Hours </option>
                                                    <option value="6"> 6 Hours </option>
                                                    <option value="7"> 7 Hours </option>
                                                    <option value="8"> 8 Hours </option>
                                                    <option value="9"> 9 Hours </option>
                                                    <option value="10"> 10 Hours </option>
                                                </select>
                                            </div>
                                            <button type='submit' class="btn btn-danger btn-xs">Add to cart</button>
                                        </form>
                                        {{-- <a href="" class='btn btn-danger btn-xs'>
                                            Book
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                {{-- <div class="col-lg-3 white">
                    <h2> Availability </h2>

                    <form method="POST" action="/bookings/begin">
                    {{csrf_field()}}
                    <input type="hidden" name="restaurant_id" value="{{$rest->id}}">
                    <div class="form-group">
                        <label for="inputNumberOfPeople">Number of people</label>
                        <input type="number" class="form-control" id="inputNumberOfPeople" name="number_of_people" placeholder="1">
                    </div>
                    <div class="form-group">
                        <label for="inputBookingDate">Booking date</label>
                        <input type="date" class="form-control" id="inputBookingDate" placeholder="dd/mm/yy" name="booking_date">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div> --}}
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript" src='{!! asset('js/jquery.datetimepicker.full.min.js') !!}'></script>
    <script type="text/javascript">
    jQuery('.bookDate').datetimepicker({
        format:'d.m.Y H:i',
        lang:'eng'
    });
    </script>
@endsection
