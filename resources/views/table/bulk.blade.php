@extends ('layouts.restaurant_setup')

@section('content')

<div class="row">
  <h2> Add the Tables' details</h2>
  <div class="col-sm-4">
    <div class="alert" role="alert" id="prompt" hidden>
    </div>
    <fieldset>
      <legend>Table Details</legend>
      
      <!-- Enter details manually-->
      <!--Seats Number per table -->
      <div class = "form-group">
      <label for = "seats" class = "control-label"> Number of seats</label>
      <input type = "text" class = "form-control" id = "seats" placeholder = "4">
      </div>

      <!--tables with the given seat number -->
      <div class = "form-group">
        <label for = "tables" class = "control-label"> Number of tables</label>
        <input type = "text" class = "form-control" id = "tables_number" placeholder = "10">
      </div>

      <input hidden id="rest_id" value="{{ $restaurant_id }}"/>

      <!-- add button for table field -->
      <button type = "button" class = "btn btn-primary" id="add_table">Add</button>

    </fieldset>

    <!--next button -->
    <button type = "button" class = "btn btn-primary btn-lg" id="submit">Next</button>
  </div>
  <div class="col-sm-4">
    <table  id="added_tables" class="table">
      
    </table>
  </div>
</div>

<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' } });
</script>
<script type="text/javascript" src="/js/add_tables.js"></script>

@endsection
