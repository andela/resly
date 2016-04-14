@extends('dashboard.restaurant_page')

@section('styles')
    @parent
    <link rel="stylesheet" type="text/css" href="{!! asset('css/jquery.datetimepicker.css') !!}">
    <link rel='stylesheet' href="{{ asset('fancybox/source/jquery.fancybox.css') }}" />

    <style type="text/css">
      .multiple_book {
        pointer : cursor;
      }

      .single_book {
        background-color: #889;
        color: #fff;
      }

      .single_book:hover {
        background-color: #990000;
      }

      .multiple_book {
        background-color: #889;
        color: #fff;
      }

      .multiple_book:hover {
        background-color: #090;
      }

      .multiple_trigger_button {
        border-radius: 0px;
        border: medium 1px #fff;
      }

      .multiple_trigger_button:hover {
        background-color: #900;
        color: #fff;
      }
    </style>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
    $(document).ready(function () {

        var tableToBook;
        var returnTable;

        $('.single_book').click(function (e) {
            e.preventDefault();

            book = $(this).attr('book');
            tableToBook = parseInt(book.split('_')[1]);
            $.get('/tables/' + tableToBook, function (d) {
              returnTable = JSON.parse(d);
              $('#booking_form').attr('bookingMode', function () {
                return 'single';
              });
                var preparedHtML = '';
                preparedHtML += '<tr>';
                preparedHtML += '<td>' + returnTable.label + '</td>';
                preparedHtML += '<td>' + returnTable.seats_number + '</td>';
                preparedHtML += '<td>' + returnTable.cost + '</td></tr>';
                preparedHtML += '</tr>';
              $('#bookedRows').html(preparedHtML);
            });
        });

        $('.closeMultiple').click(function (e) {
            e.preventDefault();

            $.post('/clear/bookings', function (d) {
              if (JSON.parse(d) == true) {
                $('#bookedNumber').html(0);
                $('.res_table_row').css('background', '#fff');
              }
            });
        });

        $('.processMultiple').click(function (e) {
            e.preventDefault();

            $.get('/book/multipletables', function (d) {
              data = JSON.parse(d);
              returnTables = data.tables;
              count = returnTables.length;
              $('#booking_form').attr('bookingMode', function () {
                return 'multiple';
              });
              var preparedHtML = '';
              if (count < 1) {
                preparedHtML = '<tr><th colspan="3" style="text-align: center;">Empty. Hold a table to book.</th></tr>'
              } else {
                for (var i = 0; i < count; i++) {
                  preparedHtML += '<tr>';
                    preparedHtML += '<td>' + returnTables[i].label + '</td>';
                    preparedHtML += '<td>' + returnTables[i].seats_number + '</td>';
                    preparedHtML += '<td>$' + returnTables[i].cost + '</td></tr>';
                  preparedHtML += '</tr>';
                }
                sum = data.sum;
                preparedHtML += '<tr><th colspan="2">TOTAL</th><th>' + sum + '</th></tr>';
              }
              $('#bookedRows').html(preparedHtML);
            });
        });



        var bookingMode;
        var responseData;

        $("#submitBookings").click(function (e) {
            e.preventDefault();

            bookDate = $('#bookDate').val();
            bookDuration = $('#bookDuration').val();
            bookingMode = $('#booking_form').attr('bookingMode');
            bookingData = {date: bookDate, duration: bookDuration};

            if (bookingMode === 'single') {
              $.post('/booking/table/' + tableToBook + '/add', bookingData, function (d) {
                respondWith(d);
                updateTable(tableToBook);
              });
            }
            if (bookingMode === 'multiple') {
              $.post('/booking/tables/add', {date: bookDate, duration: bookDuration}, function (d) {
                respondWith(d);
                updateTables(d);
              });
            }
        });

        var updateTable = function (id) {
          bookedButton = '<button class="" disabled="" style="cursor: not-allowed;">Booked</button>';
          $(".bookStatus#bookStatus_" + id).html(bookedButton);
        }

        var updateTables = function (d) {
          ids = (JSON.parse(d)).tables;
          count = ids.length;
          for (var i = 0; i < count; i++) {
            updateTable(ids[i]);
          }
        }

        var respondWith = function (returnData) {
            responseData = JSON.parse(returnData);
            if (responseData.status == 'failure') {
              alertify.error(responseData.message);
            } else if (responseData.status == 'success') {
              $(".closeBookingForm").trigger('click');
              alertify.success(responseData.message);
            }
        }
        $(".multiple_book").click(function (e) {
            e.preventDefault();

            id = $(this).attr('id');
            $('#booking_form').attr('bookingMode', function () {
              return 'multiple';
            });

            $.post('/multiple/book', {table: id}, function (data) {
              id = id;
              data = JSON.parse(data);
              count = data.length;
              $('#bookedNumber').html(count);
                if (data.indexOf(id) == -1) {
                  $('#' + id).parents('.res_table_row#table_' + id).css('background-color', '#fff');
                  $('#' + id).html('Hold');
                } else {
                  $('#' + id).html('Unhold');
                  $('#' + id).parents('.res_table_row#table_' + id).css('background-color', '#ffe');
                }
            });


        });
    });
    </script>
@endsection

@section('title-suffix', '- Tables')
@section('details')
    @parent
    @include ('partials.alerts')

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close closeBookingForm" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Process Multiple Bookings</h4>
          </div>
         <div class="modal-body">
            <form bookingMode="" id="booking_form" method='post'>
                {{csrf_field()}}
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Table</th>
                      <th>Seats</th>
                      <th>Cost</th>
                    </tr>
                  </thead>
                  <tbody id="bookedRows">
                  </tbody>
                </table>
                <table class="table table-not-striped" id="processTable">
                  <tr>
                      <td>Date</td>
                      <td>Duration</td>
                  </tr>
                  <tr id="processRow">
                      <td><input type='text' class='bookDate form-control' name='date' id="bookDate" placeholder="Dining Date" required="required"></td>
                      <td>
                          <select name='duration' placeholder='Duration' class='form-control' id="bookDuration">
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
                  </tr>
                </table>
         <div class="modal-footer">
            <button type="button" class="btn btn-default"
               data-dismiss="modal">Close
            </button>
            <button type='submit' name='submitBookings' id='submitBookings' class='btn btn-primary'>Add to cart</button>
         </div>
         </form>
         </div>
      </div>
  </div>
</div>

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
                  <div class="wrapper">
                    <div class="row">
                      <div class="col-md-6">
                        <p>{{$restaurant->location}}</p>
                        <p>
                            <i class='fa fa-clock-o'></i>
                            {{$restaurant->opening_time}} - {{$restaurant->closing_time}}
                        </p>
                        <p style="color:red;">* please note that the cost shown is for only one hour</p>
                      </div>
                      <div class="col-md-6 multiple_trigger">
                          <button class="btn btn-primary btn-lg pull-right multiple_trigger_button" id="bookedNumber" data-toggle="modal" data-target="#myModal">{{$count}}</button>
                          <button class="btn btn-primary btn-lg pull-right multiple_trigger_button processMultiple" data-toggle="modal" data-target="#myModal">Process Booking</button>
                          <button class="btn btn-primary btn-lg pull-right multiple_trigger_button closeMultiple">&times;</button>
                      </div>
                    </div>
                  </div>
                    <table class="table">
                        <tbody>
                            @foreach ($restaurant->tables as $index => $table )
                                <tr class="res_table_row" id="table_{{$table->id}}">
                                    <td class='table-image-holder'>
                                        @if($table->avatar !== null)
                                          <a href='{{$table->avatar}}' class='fancybox'>
                                            <img src="{{$table->avatar}}" class='table-image'>
                                          </a>
                                        @else
                                            <img src="{{asset('img/no-image-placeholder.jpg')}}" class='table-image'>

                                        @endif

                                    </td>
                                    <td>
                                        <h3>{{$table->label}}<span class='pull-right'>{{ $table->seats_number }} seats</span></h3>
                                        <hr>
                                        <p>
                                            <strong>Table Description: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                            {{$table->seats_number}} Seats on this table
                                            <span class="price pull-right">$ {{number_format($table->cost)}}</span>
                                        </p>
                                        <div class="bookStatus" id="bookStatus_{{$table->id}}">
                                          @if ($table->is_booked)
                                            <button disabled="" style="cursor: not-allowed;">Booked</button>
                                          @else
                                            <button class="single_book" book="book_{{$table->id}}" data-toggle="modal" data-target="#myModal">Book Now</button>
                                            <button class="multiple_book" id="{{$table->id}}" book="add_book_{{$table->id}}">Hold</button>
                                          @endif
                                        </div>
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
    <script type="text/javascript" src='{!! asset('js/jquery.datetimepicker.full.min.js') !!}'>
    </script>
    <script type="text/javascript" src='{!! asset('js/moment.min.js') !!}'></script>
    <script type="text/javascript" src='{!! asset('js/moment-timezone.min.js') !!}'></script>
    <script type="text/javascript" src="{{ asset('fancybox/source/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src='{!! asset('js/book_table.js') !!}'></script>

@endsection

