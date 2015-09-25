$(document).ready(function(){

  var table_count = 0;
  var table_track = {};

  $('#add_table').click(function(){
    var seats = $('#number').val();
  });


  /**
  *   This function takes the provided table data and
  *   injects it into the DOM, in the #added_tables section.
  */

  var add_table_view = function(table_data) {
    var table_id = table_count;

    table_count++;
  };

});
