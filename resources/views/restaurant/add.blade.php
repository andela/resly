@extends('layouts.restaurant_setup')

@section('content')

  <div class="col-sm-6">
    <h2>Add the details of the restaurant</h2>
        
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
            placeholder = "Enter name" name= "name">
      </div>

      <!-- Add Description of restaurant -->
      <div class ="form-group">
        <label for= "cuisine" class= "control-label"> Description</label>
        <textarea class = "form-control" name= "description" id = "cuisine" rows= "7" placeholder = "e.g. cuisine and selling point"></textarea>
      </div>

      <!-- Add Opening and Closing Hours of restaurant -->
      <div class = "form-group">
        <div class = "row">
          <div class = "col-sm-6">
            <label for = "opening-hours" class = "control-label"> Opening Time</label>
            <input class = "form-control" id = "opening-hours" name="opening_time" placeholder = "09:00 (In 24hr system)"></input>
          </div>
          
          <div class = "col-sm-6">
            <label for = "closing-time" class = "control-label"> Closing Time</label>
            <input class = "form-control" id = "closing-time" name="closing_time" placeholder = "22:00"></input>
          </div>
        </div>
      </div>

        <!-- Add where restaurant is located -->
      <div class= "form-group">
        <label for = "location" class= "control-label"> Location</label>
        <input type = "text" class = "form-control" id= "location" name="location" placeholder = "Enter physical location">
      </div>

      <!-- Add contact information of restaurant -->
      <fieldset>
        <legend>Contact information</legend>
       
        <!-- Telephone number -->
        <div class = "form-group">
          <label for = "telephone" class = "control-label"> Telephone Number</label>
          <input type = "tel" class = "form-control" id = "telephone" name="telephone" placeholder = "Enter phone number">
        </div>

        <!-- Email address -->
        <div class = "form-group">
          <label for = "email-address" class = "control-label"> Email address</label>
          <input type = "email" class = "form-control" name="email" id = "email-address" placeholder = "Enter email address">
        </div>
        
         <!-- Postal address -->
        <div class = "form-group">
          <label for = "postal" class = "control-label"> Postal address</label>
          <input type = "text" class = "form-control" name="address" id = "postal" placeholder = "Enter postal address">
        </div>  
      </fieldset>

      <div class = "form-group">
        <button type = "submit" class = "btn btn-primary btn-lg">Next</button>
      </div>  
    </form>
  </div>

@endsection