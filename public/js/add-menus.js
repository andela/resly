$(document).ready(function() {

  var menusTrack = [];

  /**
   *   This function takes the menu data and
   *   updates the DOM, in the #added_items section.
   */

  function updateTable() {
    var tableView = $("#added_items");
    if (menusTrack.length == 0) {
      tableView.html("");
      return false;
    }

    tableView.html("<tr>" +
      "<th>Menu Item</th>" +
      "<th>Category</th>" +
      "<th>Description</th>" +
      "<th>Price</th>" +
      "<th>Tags</th>" +
      "</tr>");

    // Loop through the addedItems and print
    for (var i = 0; i < menusTrack.length; i++) {
      var row = "<td> " + menusTrack[i].name + "</td>";
      row += "<td> " + menusTrack[i].category + "</td>";
      row += "<td> " + menusTrack[i].description + "</td>";
      row += "<td> " + menusTrack[i].price + "</td>";
      row += "<td> " + menusTrack[i].tags + "</td>";
      tableView.append("<tr>" + row + "</tr>");
    }
  }

  function clearFields() {
    $("#name").val("");
    $("#description").val("");
    $("#price").val("");
    $("#tags").val("");
  }

  function serializeArray() {
    var finalObj = { menu_items : {} };
    for(var i = 0; i < menusTrack.length; i++) {
      finalObj.menu_items["" + i] = menusTrack[i];
    }

    finalObj.restaurant_id = $("#restaurant_id").val();
    menusTrack = finalObj;
    console.dir(menusTrack);
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

  $("#add").click(function() {
    var name = $("#name").val();
    var category = $("#categories").val();
    var description = $("#description").val();
    var price = $("#price").val();
    var tags = $("#tags").val();

    if (name.length == 0 || category.length == 0) {
      prompt("Please provide a name and category");
      return false;
    }
    if (isNaN(parseInt(price))) {
      prompt("Please input a number for price");
      return false;
    }

    var record = {
        name : name,
        category : category,
        description : description,
        price : price,
        tags : tags
      };

    menusTrack.push(record);

    prompt(JSON.stringify(record) + " added.");
    updateTable();
    clearFields();
  });

  $("#next_link").submit(function(event) {
    event.preventDefault();
    serializeArray();

    var request = $.ajax({
      url: "/menus/add-bulk",
      method: "POST",
      data: JSON.stringify(menusTrack),
      contentType: "application/json"
    });

    request.done(function(msg) {
      // load the next page here, using window.location.replace()
      alert("response: "+msg);
    });
  });

});
