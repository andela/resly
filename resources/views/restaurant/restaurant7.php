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
        <h3>Drinks details</h3>
        <br>
        <fieldset>
          <legend>Category</legend>

          <!--Select category-->
          <div class = "form-group">
          <label for = "category" class = "col-sm-2 control-label"> Category</label>
          <div class = "col-sm-4">
            <select class = "form-control">
              <option>Alcoholic</option>
              <option>Non-alcoholic</option>
            </select>
          </div>
          </div>

          <!--subcategory of the drinks-->
          <div class = "form-group">
          <label for = "subcategory" class = "col-sm-2 control-label"> Subcategory</label>
          <div class = "col-sm-4">
            <input type = "text" class = "form-control" id = "subcategory" placeholder = "e.g. smoothies">
          </div>
          </div>

          <!--enter Drinks details-->
          <fieldset>
            <legend>Drink</legend>
            <!-- Name of drink-->
            <div class = "form-group">
            <label for = "drink-name" class = "col-sm-2 control-label"> Name</label>
            <div class = "col-sm-4">
              <input type = "text" class = "form-control" id = "drink-name" placeholder = "Enter name of drink">
            </div>
            </div>

            <!--Description of the dish -->
            <div class = "form-group">
            <label for = "drink-description" class = "col-sm-2 control-label"> Description</label>
            <div class = "col-sm-4">
              <textarea class = "form-control" id = "drink-description" rows= "6" placeholder = "e.g. Mixture of mangoes,apples and berries"></textarea>
            </div>
            </div>

            <!--price of the dish-->
            <div class = "form-group">
            <label for = "drink-price" class = "col-sm-2 control-label"> Price</label>
            <div class = "col-sm-4">
              <input type = "number" class = "form-control" id = "drink-price" placeholder = "Enter price">
            </div>
            </div>

            <!--Upload picture of dish-->
            <div class = "form-group">
            <label for = "drink-photo" class = "col-sm-2 control-label"> Picture (optional)</label>
            <div class = "col-sm-4">
              <input type = "file" class = "form-control" id = "drink-photo">
            </div>
            </div>

            <!-- add button for drink field -->
            <button type = "button" class = "btn btn-primary btn-lg col-sm-offset-10">Add Drink</button>
          </fieldset>

          <!-- add button for category field -->
          <button type = "button" class = "btn btn-primary btn-lg col-sm-offset-10">Add Category</button>
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