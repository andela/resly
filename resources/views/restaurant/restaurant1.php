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
    <div  class = "container">
      <form class= "form-horizontal" role = "form">

        <!-- Add Name of restaurant -->
        <div class= "form-group">
          <h2>Add the details of the restaurant</h2>
          <label for= "name" class= "col-sm-2 control-label"> Name of restaurant</label>
          <div class = "col-sm-4">
            <input type = "text" class = "form-control" id= "name" placeholder = "Enter name">
          </div>
        </div>

      <!-- Add Description of restaurant -->
      <div class ="form-group">
        <label for= "cuisine" class= "col-sm-2 control-label"> Description</label>
          <div class = "col-sm-4">
            <textarea class = "form-control" id = "cuisine" rows= "7" placeholder = "e.g. cuisine and selling point"></textarea>
          </div>
      </div>

      <!-- Add Opening and Closing Hours of restaurant -->
      <div class = "form-group">
        <div class = "row">
          <label for = "opening-hours" class = "col-sm-2 control-label"> Opening Hours</label>
          <div class = "col-sm-4">
            <textarea class = "form-control" id = "opening-hours" rows= "5" placeholder = "e.g. Monday 09:00 - 22:00"></textarea>
          </div>

          <label for = "closing-time" class = "col-sm-2 control-label"> Closing Hours</label>
          <div class = "col-sm-4">
            <textarea class = "form-control" id = "closing-time" rows= "5" placeholder = "e.g. Sunday 00:00 - 22:00"></textarea>
          </div>
        </div>
      </div>

        <!-- Add where restaurant is located -->
      <div class= "form-group">
        <br>
        <label for = "location" class= "col-sm-2 control-label"> Location</label>
        <div class = "col-sm-4">
          <input type = "text" class = "form-control" id= "location" placeholder = "Enter physical location">
        </div>
      </div> 
      <br>

      <!-- Add contact information of restaurant -->
      <fieldset>
        <legend>Contact information</legend>
       
        <!-- Telephone number -->
        <div class = "form-group">
          <label for = "telephone" class = "col-sm-2 control-label"> Telephone Number</label>
          <div class = "col-sm-4">
            <input type = "tel" class = "form-control" id = "telephone" placeholder = "Enter phone number">
          </div>
        </div>

        <!-- Email address -->
        <div class = "form-group">
          <label for = "email-address" class = "col-sm-2 control-label"> Email address</label>
          <div class = "col-sm-4">
            <input type = "email" class = "form-control" id = "email-address" placeholder = "Enter email address">
          </div>
        </div>
        
         <!-- Postal address -->
        <div class = "form-group">
          <label for = "postal" class = "col-sm-2 control-label"> Postal address</label>
          <div class = "col-sm-4">
            <input type = "text" class = "form-control" id = "postal" placeholder = "Enter postal address">
          </div>
        </div>  
      </fieldset>

      <button type = "button" class = "btn btn-primary btn-lg col-sm-offset-11">Next</button>

      </form>
    </div>
  
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>

</html>