<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" 
    content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">  
  </head>
  <body>
    <div class = "container">
      <form class= "form-horizontal" role = "form">
        <h3>Upload the Floor plan</h3>
        <br>
        <p>Upload the floor plan of the restaurants, including the floor levels</p>
        <div class = "form-group">
          <label for = "floor-plan" class = "col-sm-2 control-label"> Floor plan</label>
          <div class = "col-sm-4">
            <input type = "file" class = "form-control" id = "floor-plan">
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