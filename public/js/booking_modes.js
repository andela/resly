// JS to handle different modes of booking a table.

$(document).ready(function () {

        for (var i = 0; i < count; i++) {
          $('.multiple_book#' + tableIDs[i]).html('Un');
          $('.res_table_row#table_' + tableIDs[i]).css('background', '#ffe');
        };

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
                preparedHtML += '<td>$' + returnTable.cost + '</td></tr>';
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
                $('.multiple_book').html('Select');
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
                preparedHtML = '<tr><th colspan="3" style="text-align: center;">Empty. Select a table to book.</th></tr>'
              } else {
                for (var i = 0; i < count; i++) {
                  preparedHtML += '<tr>';
                    preparedHtML += '<td>' + returnTables[i].label + '</td>';
                    preparedHtML += '<td>' + returnTables[i].seats_number + '</td>';
                    preparedHtML += '<td>$' + returnTables[i].cost + '</td></tr>';
                  preparedHtML += '</tr>';
                }
                sum = data.sum;
                total_seats = data.total_seats;
                preparedHtML += '<tr><th>TOTAL</th><th>' + total_seats + '</th><th>$' + sum + '</th></tr>';
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
              $.post('/booking/tables/add', bookingData, function (d) {
                respondWith(d);
                updateTables(d);
              });
            }
            $('#bookedNumber').html(0);
        });

        var updateTable = function (id) {
          Selected = '<button class="btn btn-primary" disabled="" style="cursor: not-allowed;">Selected</button>';
          $(".bookStatus#bookStatus_" + id).html(Selected);
          $('.res_table_row#table_' + id).css('background-color', '#fff');
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
                  $('#' + id).html('Select');
                } else {
                  $('#' + id).html('Remove');
                  $('#' + id).parents('.res_table_row#table_' + id).css('background-color', '#ffe');
                }
            });


        });
    });