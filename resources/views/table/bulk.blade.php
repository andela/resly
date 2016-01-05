@extends ('layouts.master')

@section('content')
<style type="text/css">
  fieldset {
    border: 1px groove;
    padding:0 10px 10px 10px;
    margin: 0 0 10px 0;
  }
  legend {
    font-weight: bold;
    text-align: left;
    width: inherit;
    padding: 0 10px;
    border-bottom: none;
  }
  .dark {
    background-color: #FFF;
    margin: 80px 20px 20px 30px;
    padding: 20px 20px 20px 20px;
  }
  .alert {
    color: #444444;
    height: 10px;
  }
</style>
<div class="content">
  <div class="col-sm-4 dark">
  <h4> Add the Tables' details</h4>
    <div class="alert dark" role="alert" id="prompt" hidden>
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
  <div class="col-sm-4 dark">
    <h4>Added Tables</h4>
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
