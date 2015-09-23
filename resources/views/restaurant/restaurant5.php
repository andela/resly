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
        <h3>Entree details</h3>
        <br>
        <fieldset>
          <legend>Entree</legend>
          
          <!-- Name of dish -->
          <div class = "form-group">
          <label for = "entree-name" class = "col-sm-2 control-label"> Name</label>
          <div class = "col-sm-4">
            <input type = "text" class = "form-control" id = "entree-name" placeholder = "Enter name of entree">
          </div>
          </div>

          <!--Description of the dish -->
          <div class = "form-group">
          <label for = "entree-description" class = "col-sm-2 control-label"> Description</label>
          <div class = "col-sm-4">
            <textarea class = "form-control" id = "entree-description" rows= "6" placeholder = "e.g. Main ingredients and selling point"></textarea>
          </div>
          </div>

          <!--price of the dish-->
          <div class = "form-group">
          <label for = "entree-price" class = "col-sm-2 control-label"> Price</label>
          <div class = "col-sm-4">
            <input type = "number" class = "form-control" id = "entree-price" placeholder = "Enter price">
          </div>
          </div>

          <!--Upload picture of dish-->
          <div class = "form-group">
          <label for = "entree-photo" class = "col-sm-2 control-label"> Picture (optional)</label>
          <div class = "col-sm-4">
            <input type = "file" class = "form-control" id = "entree-photo">
          </div>
          </div>

          <!-- add button for appetizer field -->
          <button type = "button" class = "btn btn-primary btn-lg col-sm-offset-11">Add</button>
        </fieldset>
        <p>Click next to move to the next menu category</p>
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