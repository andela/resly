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

                 <div class="col col-md-12">
                    <p>{{$restaurant->location}}</p>
                    <p>
                        <i class='fa fa-clock-o'></i>
                        {{$restaurant->opening_time}} -
                        {{$restaurant->closing_time}}

                    </p>
                    <p style="color:red;">* please note that the cost shown is for only one hour</p>
                    <table class="table">
                        <tbody>
                            @foreach ($restaurant->tables as $index => $table )
                                <tr>
                                    <td class='table-image-holder'>
                                        @if($table->avatar !== null)
                                            <img src="{{$table->avatar}}" class='table-image'>
                                        @else
                                            <img src="{{asset('img/no-image-placeholder.jpg')}}" class='table-image'>

                                        @endif

                                    </td>
                                    <td>
                                        <h3>{{$table->label}}</h3>
                                        <hr>
                                        <p>
                                            <strong>Table Description: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                            {{$table->seats_number}} Seats on this table
                                            <span class="price pull-right">$ {{number_format($table->cost)}}</span>
                                        </p>
                                        <form action="{{url('/booking/table/'.$table->id.'/add')}}" method='post'>
                                            {{csrf_field()}}
                                            <table class="table table-not-striped">
                                              <tr>
                                                  <td>Date</td>
                                                  <td>Duration</td>
                                                  <td></td>
                                              </tr>
                                              <tr>
                                                  <td><input type='text' class='bookDate form-control' name='date' placeholder="Dining Date"></td>
                                                  <td>
                                                      <select name='duration' placeholder='Duration' class='form-control'>
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
                                                  </td>
                                                  <td>
                                                      <button type='submit' class="btn btn-danger btn-xs">Add to cart</button>
                                                  </td>
                                              </tr>
                                            </table>

                                        </form>
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
