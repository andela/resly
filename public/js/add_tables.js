$(document).ready(function() {

  var tableTrack = {
    addedTables : {}
  };

  /**
   *   This function takes the table data and
   *   updates the DOM, in the #added_tables section.
   */

  function updateTable() {
    var keys = Object.keys(tableTrack.addedTables);
    var tableView = $("#added_tables");
    if (keys.length === 0) {
      tableView.html("");
      return false;
    }

    tableView.html("<tr>" +
      "<th>Number of seats</th>" +
      "<th>Number of tables</th>" +
      "</tr>");

    for (var i = 0; i < keys.length; i++) {
      var row = "<tr><td> " + keys[i] + " </td>";
      row += "<td> " + tableTrack.addedTables[keys[i]] + " </td></tr>"
      tableView.append(row);
    }
  }

  /**
   *   This function alerts the user with necessary messages.
   */

  var prompt = function(msg) {
    $("#prompt").show();
    $("#prompt").html(msg);

    // Hide the alert
    $("#prompt").fadeOut(1600);
  };


  $("#add_table").click(function() {
    var seats = parseInt($("#seats").val());
    var tablesNumber = parseInt($("#tables_number").val());

    // Clear the input fields
    $("#seats").val("");
    $("#tables_number").val("");

    if (isNaN(seats) || isNaN(tablesNumber)) {
      prompt("Please Input numbers only.");
      return false;
    }

    var index = seats + "";

    if (!tableTrack.addedTables[index]) {
      tableTrack.addedTables[index] = tablesNumber;
    } else {
      tableTrack.addedTables[index] += tablesNumber;
    }

    prompt(tablesNumber + ", " + seats + "-seater tables added");
    updateTable();
  });

  $("#submit").click(function() {

    if (Object.keys(tableTrack).length === 0) {
      prompt("Please add atleast one table");
      return false;
    }

    tableTrack.restaurant_id = parseInt($("#rest_id").val());

    var request = $.ajax({
      url: "/tables/add-bulk",
      method: "POST",
      data: JSON.stringify(tableTrack),
      contentType: "application/json"
    });

    request.done(function(res_id) {
      // load the next page here
      window.location.replace("/menus/add-bulk");
    });
  });

});
