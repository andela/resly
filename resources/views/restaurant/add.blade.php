@extends('dashboard.index')

@section('title', 'Add Restaurant')

@section('details')

<style type="text/css">
  fieldset {
    border: 1px groove;
    padding:0 10px 10px 10px;
    margin: 0 0 10px 0;
  }
  legend {
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
</style>
<script type="text/javascript">
  jQuery("document").ready(function($){
    $('#opening-hours').wickedpicker({twentyFour: true});  
    $('#closing-time').wickedpicker({twentyFour: true});  
  });
  
</script>

  <div class="content">
    <div class="col-sm-12 dark">
      <h4>Add the details of the restaurant</h4>
          
      <form  method="POST" action="/restaurants/add">
      
        <div class="row">
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
          @endif
        </div>

        {{ csrf_field() }}

        <!-- Add Name of restaurant -->
        <div class= "form-group">
          <label for= "name" class= "control-label"> Name of restaurant</label>
          <input type = "text" class = "form-control" id= "restaurant_name" 
              placeholder = "Enter name" name= "name" value="{{ old('name') }}">
        </div>

        <!-- Add Description of restaurant -->
        <div class ="form-group">
          <label for= "cuisine" class= "control-label"> Description</label>
          <textarea class = "form-control" name= "description" id = "cuisine" rows= "5" placeholder = "e.g. cuisine and selling point">{{ old('description') }}</textarea>
        </div>

        <!-- Add Opening and Closing Hours of restaurant -->
        <div class = "form-group">
          <div class = "row">
            <div class = "col-sm-6">
              <label for = "opening-hours" class = "control-label"> Opening Time</label>
              <input class = "form-control" id = "opening-hours" name="opening_time" placeholder = "Pick Opening Time (24hrs format)" value="{{ old('opening_time') }}">
            </div>
            
            <div class = "col-sm-6">
              <label for = "closing-time" class = "control-label"> Closing Time</label>
              <input class = "form-control" id = "closing-time" name="closing_time" placeholder = "Pick Closing Time (24hrs format)" value="{{ old('closing_time') }}">
            </div>
          </div>
        </div>

          <!-- Add where restaurant is located -->
        <div class= "form-group">
          <label for = "location" class= "control-label"> Location</label>
          <input type = "text" class = "form-control" id= "location" name="location" placeholder = "Enter physical location" value="{{ old('location') }}">
        </div>

        <!-- Add contact information of restaurant -->
        <fieldset>
          <legend>Contact information</legend>
         
          <!-- Telephone number -->
          <div class = "form-group">
            <label for = "telephone" class = "control-label"> Telephone Number</label>
            <input type = "tel" class = "form-control" id = "telephone" 
              name="telephone" placeholder = "Enter phone number" value="{{ old('telephone') }}">
          </div>

          <!-- Email address -->
          <div class = "form-group">
            <label for = "email-address" class = "control-label"> Email address</label>
            <input type = "email" class = "form-control" name="email" id = "email-address" 
              value="{{ old('email') }}" placeholder = "Enter email address">
          </div>
          
           <!-- Postal address -->
          <div class = "form-group">
            <label for = "postal" class = "control-label"> Postal address</label>
            <input type = "text" class = "form-control" name="address" id = "postal" 
              value="{{ old('address') }}" placeholder = "Enter postal address">
          </div>  
        </fieldset>

        <div class = "form-group">
          <button type = "submit" class = "btn btn-primary btn-lg" style="float:right">Next</button>
        </div>  
      </form>
    </div>
  </div>

@endsection