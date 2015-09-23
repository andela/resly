<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" 
    content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 

  <!--link the css stylesheet for fieldsets -->
  <link rel = "stylesheet" type = "text/css" href = "/css/restaurant1.css"> 
  </head>
  <body>
    <div class = "container">
      <form class= "form-horizontal" role = "form">
        <h2> Add the Tables' details</h2>
        <br>
        <p>Enter the table details <em>manually</em> or <em>upload a file</em></p>
        <br>
        <fieldset>
          <legend>Table Details</legend>
          
          <!-- Enter details manually-->
          <!--Seats Number per table -->
          <div class = "form-group">
          <label for = "seats" class = "col-sm-2 control-label"> Number of seats</label>
          <div class = "col-sm-4">
            <input type = "number" class = "form-control" id = "seats" placeholder = "Enter seats per table">
            <datalist>
              <option value= "1"></option>
              <option value= "2"></option>
              <option value= "3"></option>
              <option value= "4"></option>
            </datalist>
          </div>
          </div>

          <!--tables with the given seat number -->
          <div class = "form-group">
            <label for = "tables" class = "col-sm-2 control-label"> Tables number</label>
          <div class = "col-sm-4">
            <input type = "number" class = "form-control" id = "tables" placeholder = "Enter tables with given seat number">
            <datalist>
              <option value= "1"></option>
              <option value= "2"></option>
              <option value= "3"></option>
              <option value= "4"></option>
            </datalist>
          </div>
          </div>

          <!--table shape -->
          <div class = "form-group">
            <label for = "shape" class = "col-sm-2 control-label"> Table shape (optional)</label>
          <div class = "col-sm-4">
            <input type = "text" class = "form-control" id = "shape" placeholder = "Enter shape of the tables in this seat group">
          </div>
          </div>

          <!-- Table location with regards to the floor -->
          <div class = "form-group">
            <label for = "table-location" class = "col-sm-2 control-label"> Table location (optional)</label>
          <div class = "col-sm-4">
            <input type = "text" class = "form-control" id = "table-location" placeholder = "Enter position of table with regards to floor">
          </div>
          </div>

          <!-- add button for table field -->
          <button type = "button" class = "btn btn-primary btn-lg col-sm-offset-11">Add</button>
        </fieldset>

        <!--Upload a file -->
        <h3> OR </h3>
        <p>Upload a file with the table details categorized as above</p>
        <br>
        <div class = "form-group">
          <label for = "input-file" class = "col-sm-2 control-label"> File input for table</label>
          <div class = "col-sm-4">
            <input type = "file" class = "form-control" id = "input-file">
          </div>
        </div>

        <!--next button -->
        <button type = "button" class = "btn btn-primary btn-lg col-sm-offset-11">Next</button>
      </form>
    </div>
  	
  	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>

</html>