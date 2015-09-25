@extends ('layouts.restaurant_setup')

@section('content')

<div class="row">  
  <div class="col-sm-6">
    <form role = "form" method="POST" action="">
      <h2> Add the Tables' details</h2>
      <br>
      <p>Enter the table details <em>manually</em> or <em>upload a file</em></p>
      <br>
      <fieldset>
        <legend>Table Details</legend>
        
        <!-- Enter details manually-->
        <!--Seats Number per table -->
        <div class = "form-group">
        <label for = "seats" class = "control-label"> Number of seats</label>
        <input type = "number" class = "form-control" id = "seats" placeholder = "Enter seats per table">
          <datalist>
            <option value= "1"></option>
            <option value= "2"></option>
            <option value= "3"></option>
            <option value= "4"></option>
          </datalist>
        </div>

        <!--tables with the given seat number -->
        <div class = "form-group">
          <label for = "tables" class = "control-label"> Tables number</label>
          <input type = "number" class = "form-control" id = "tables" placeholder = "Enter tables with given seat number">
            <datalist>
              <option value= "1"></option>
              <option value= "2"></option>
              <option value= "3"></option>
              <option value= "4"></option>
            </datalist>
        </div>

        <!--table shape -->
        <div class = "form-group">
          <label for = "shape" class = "control-label"> Table shape</label>
          <select type = "text" class = "form-control" id = "shape" placeholder = "Enter shape of the tables in this seat group">
            <option value="rectangular" />
            <option value= "circle" />
          </select>
        </div>

        <!-- Table location with regards to the floor -->
        <div class = "form-group">
          <label for = "table-location" class = "control-label"> Table location (optional)</label>
          <input type = "text" class = "form-control" id = "table-location" placeholder = "Enter position of table with regards to floor">
        </div>

        <!-- add button for table field -->
        <button type = "button" class = "btn btn-primary btn-lg" id="add_table">Add</button>
      </fieldset>

      <!--next button -->
      <button type = "submit" class = "btn btn-primary btn-lg">Next</button>
    </form>
  </div>
  <div class="col-sm-6" id="added_tables">
    
  </div>
</div>

<script type="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/add_tables.js"></script>

@endsection